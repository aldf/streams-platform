<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Traits\CommandableTrait;

/**
 * Class HandleFormSubmissionCommandHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Form\Command
 */
class HandleFormSubmissionCommandHandler
{

    use CommandableTrait;

    /**
     * Handle the command.
     *
     * @param HandleFormSubmissionCommand $command
     */
    public function handle(HandleFormSubmissionCommand $command)
    {
        $form = $command->getForm();

        $this->execute(new BuildSubmissionDataCommand($form));
        $this->execute(new BuildSubmissionValidationRulesCommand($form));

        /**
         * Check that the user has proper authorization
         * to submit the form.
         */
        if (!$this->execute(new HandleFormSubmissionAuthorizationCommand($form))) {

            return false;
        }

        /**
         * Check that the form passes validation.
         */
        if (!$this->execute(new HandleFormSubmissionValidationCommand($form))) {

            return false;
        }

        // Let the intended redirect handle the form response.
        return $form->setResponse($this->execute(new HandleFormSubmissionRedirectCommand($form)));
    }
}
 
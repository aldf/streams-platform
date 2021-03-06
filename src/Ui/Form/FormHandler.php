<?php namespace Anomaly\Streams\Platform\Ui\Form;

/**
 * Class FormHandler
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class FormHandler
{

    /**
     * Handle the form.
     *
     * @param FormBuilder $builder
     */
    public function handle(FormBuilder $builder)
    {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveForm();
    }
}

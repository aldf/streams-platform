<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Form\FormAuthorizer;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class AuthorizeForm
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AuthorizeForm
{

    /**
     * The table builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFormColumnsCommand instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param FormAuthorizer $authorizer
     */
    public function handle(FormAuthorizer $authorizer)
    {
        $authorizer->authorize($this->builder);
    }
}

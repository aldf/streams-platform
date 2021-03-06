<?php namespace Anomaly\Streams\Platform\Field\Form\Command;

use Anomaly\Streams\Platform\Field\Form\FieldAssignmentFormBuilder;

/**
 * Class SetDefaultProperties
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class SetDefaultProperties
{

    /**
     * The table builder.
     *
     * @var FieldAssignmentFormBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultProperties instance.
     *
     * @param FieldAssignmentFormBuilder $builder
     */
    public function __construct(FieldAssignmentFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$this->builder->getStream()) {
            $parts = explode('\\', str_replace('FieldAssignmentFormBuilder', 'Model', get_class($this->builder)));

            unset($parts[count($parts) - 2]);

            $model = implode('\\', $parts);

            $this->builder->setStream(app($model)->getStream());
        }
    }
}

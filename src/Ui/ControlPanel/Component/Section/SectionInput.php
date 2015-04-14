<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class SectionInput
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section
 */
class SectionInput
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * The section guesser.
     *
     * @var SectionGuesser
     */
    protected $guesser;

    /**
     * The section evaluator.
     *
     * @var SectionEvaluator
     */
    protected $evaluator;

    /**
     * The resolver utility.
     *
     * @var SectionResolver
     */
    protected $resolver;

    /**
     * The section normalizer.
     *
     * @var SectionNormalizer
     */
    protected $normalizer;

    /**
     * Create a new SectionInput instance.
     *
     * @param SectionGuesser    $guesser
     * @param ModuleCollection  $modules
     * @param SectionResolver   $resolver
     * @param SectionEvaluator  $evaluator
     * @param SectionNormalizer $normalizer
     */
    function __construct(
        SectionGuesser $guesser,
        ModuleCollection $modules,
        SectionResolver $resolver,
        SectionEvaluator $evaluator,
        SectionNormalizer $normalizer
    ) {
        $this->guesser    = $guesser;
        $this->modules    = $modules;
        $this->resolver   = $resolver;
        $this->evaluator  = $evaluator;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the section input and process it
     * before building the objects.
     *
     * @param ControlPanelBuilder $builder
     */
    public function read(ControlPanelBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->normalizer->normalize($builder);
        $this->guesser->guess($builder);
        $this->evaluator->evaluate($builder);
    }
}

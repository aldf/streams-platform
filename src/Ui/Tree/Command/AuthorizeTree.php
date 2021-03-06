<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Ui\Tree\TreeAuthorizer;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class AuthorizeTree
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AuthorizeTree
{

    /**
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new AuthorizeTree instance.
     *
     * @param TreeBuilder $builder
     */
    public function __construct(TreeBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param TreeAuthorizer $authorizer
     */
    public function handle(TreeAuthorizer $authorizer)
    {
        $authorizer->authorize($this->builder);
    }
}

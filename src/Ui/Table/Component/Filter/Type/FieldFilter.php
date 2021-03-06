<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FieldFilterInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Filter;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query\FieldFilterQuery;

/**
 * Class FieldFilter
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class FieldFilter extends Filter implements FieldFilterInterface
{

    /**
     * The filter query.
     *
     * @var string
     */
    protected $query = FieldFilterQuery::class;

    /**
     * Get the input HTML.
     *
     * @return \Illuminate\View\View
     */
    public function getInput()
    {
        $field = $this->stream->getField($this->getField());

        $type = $field->getType();

        $type->setLocale(null);
        $type->setValue($this->getValue());
        $type->setPrefix($this->getPrefix() . 'filter_');
        $type->setPlaceholder($this->getPlaceholder());

        return $type->getFilter();
    }
}

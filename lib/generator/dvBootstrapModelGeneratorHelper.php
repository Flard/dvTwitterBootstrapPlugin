<?php
/**
 * Created by JetBrains PhpStorm.
 * User: van Horck
 * Date: 2-1-12
 * Time: 18:22
 * To change this template use File | Settings | File Templates.
 */
abstract class dvBootstrapModelGeneratorHelper extends sfModelGeneratorHelper
{
    public function linkToList($params)
    {
        return link_to(__($params['label'], array(), 'sf_admin'), '@' . $this->getUrlForAction('list'), array('class' => 'btn'));
    }

    public function linkToNew($params)
    {
        return link_to(__($params['label'], array(), 'sf_admin'), '@' . $this->getUrlForAction('new'), array('class' => 'btn success'));
    }

    public function linkToEdit($object, $params)
    {
        return link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object, array('class' => 'btn'));
    }

    public function linkToDelete($object, $params)
    {
        if ($object->isNew()) {
            return '';
        }

        return link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('class' => 'btn danger', 'method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm']));
    }

    public function linkToSave($object, $params)
    {
        return '<input type="submit" value="' . __($params['label'], array(), 'sf_admin') . '" class="btn primary" />';
    }

    public function linkToSaveAndAdd($object, $params)
    {
        if (!$object->isNew()) {
            return '';
        }

        return '<input type="submit" value="' . __($params['label'], array(), 'sf_admin') . '" name="_save_and_add" class="btn primary" />';
    }
}

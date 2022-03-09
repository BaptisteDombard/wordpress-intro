<?php

class PrimaryMenuItem
{

    protected $post;

    public $url;
    public $title;
    public $label;
    public $subitems = [];

    function __construct($post)
    {
        $this->post = $post;

        $this->url = $post->url;
        $this->label = $post->title;
        $this->title = $post->attr_title;
    }

    public function hasSubItems()
    {
        //regarder si il y a des élément dans $this->subitems. Si c'est le cas,
        //cet $item possède effectivement un sous-menu
        return ! empty($this->getParentId());
    }

    public function isSubItem()
    {
        return boolval($this->post->menu_item_parent);
    }

    public function isParentFor(PrimaryMenuItem $instance)
    {
        return ($this->post->ID == $instance->getParentId());
    }

    public function getParentId()
    {
        return $this->post->menu_item_parent;
    }

    public function addSubItem()
    {
//        $this->subitems[] = $instance;
    }

    public function getBemClasses($base){
        $icon = get_field('icon', $item);
        $modifiers = [];

        if($icon) {
            $modifiers[] = $icon;
        }

        if($this->post->object_id == get_queried_object_id()) {
            $modifiers[] = 'current';
        }

        if(in_array('menu-item-type-custom', $item->classes)) {
            $modifiers[] = 'custom';
        }

        $value = $base;

        foreach ($modifiers as $modifier) {
            $value .= ' ' . $base . '--' . $modifier;
        }

        return $value;
    }
}
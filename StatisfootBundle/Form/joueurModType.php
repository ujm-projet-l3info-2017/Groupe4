<?php

namespace Projet\StatisfootBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
* 
*/
class joueurModType extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
	}

	public function getParent(){
		return joueurType::class;
	}
}
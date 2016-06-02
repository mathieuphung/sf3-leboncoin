<?php
namespace LeBonCoinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchField', 'search', array(
                "required" => true,
                "attr" => array(
                    "placeholder" => "Rechercher...",
                    "pattern" => "^[A-Za-z0-9_\.\:\-]{3,}$",
                    "title" => "au moins 3 caractères alphanuméric (plus '.' et '_')",
                    "class" => "form-control",
                    "id" => "top-search"
                )
            ))
            ->add('categories', EntityType::class, array(
                'class' => 'LeBonCoinBundle:Categories',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }
}
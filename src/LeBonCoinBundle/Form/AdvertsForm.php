<?php
namespace LeBonCoinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class AdvertsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class)
            ->add('email', EmailType::class)
            ->add('telephoneNumber', NumberType::class)
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('images', ImagesForm::class, array(
                'required' => false,
            ))
            ->add('categories', EntityType::class, array(
                'class' => 'LeBonCoinBundle:Categories',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LeBonCoinBundle\Entity\Adverts'
        ));
    }
}
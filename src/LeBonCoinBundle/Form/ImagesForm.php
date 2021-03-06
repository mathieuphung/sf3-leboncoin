<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31/05/2016
 * Time: 15:53
 */

namespace LeBonCoinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImagesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file1', FileType::class, array(
                'label' => false,
            ))
            ->add('file2', FileType::class, array(
                'label' => false,
            ))
            ->add('file3', FileType::class, array(
                'label' => false,
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
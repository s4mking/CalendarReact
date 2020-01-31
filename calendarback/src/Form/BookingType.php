<?php

namespace App\Form;

use App\Entity\Booking;
use App\Form\DataTransformer\StringToDateTimeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $sToDTTranformer  = new StringToDateTimeTransformer();
        $builder
            ->add('beginAt')
            ->addViewTransformer($sToDTTranformer);
        $builder
            ->add('endAt')
            ->addViewTransformer($sToDTTranformer);
        $builder
            ->add('title');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}

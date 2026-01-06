<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Name product'
                ],
                'label' => 'Name',
                'label_attr' => ['class' => 'my-2']
            ])
            ->add('price', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Price product'
                ],
                'label' => 'Price product',
                'label_attr' => ['class' => 'my-2']
            ])
            ->add('stock', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Product stock number'
                ],
                'label' => 'Stock',
                'label_attr' => ['class' => 'my-2']
            ])
            ->add('createdAt', null, [
                'attr' => [
                    'class' => 'form-control'                    
                ],
                'widget' => 'single_text',
                'label_attr' => ['class' => 'my-2']
            ])
            ->add('updatedAt', null, [
                'attr' => [
                    'class' => 'form-control'                    
                ],
                'widget' => 'single_text',
                'label_attr' => ['class' => 'my-2']
            ])
            ->add('tags', EntityType::class, [                
                'attr' => [
                    'class' => 'form-control'                    
                ],
                'class' => Tag::class,
                'choice_label' => 'id',
                'multiple' => true,
                'expanded' => true,
                'label_attr' => ['class' => 'my-2']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
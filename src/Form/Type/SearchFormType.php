<?php

namespace App\Form\Type;

use App\Entity\Category;
use App\Form\Model\SearchModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('query', SearchType::class, [
                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'required' => false,
            ])
            ->add('createdThisMonth', CheckboxType::class, [
                'required' => false,
            ])
            ->setMethod('GET');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true,
            'csrf_protection' => false,
            'data_class' => SearchModel::class,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}

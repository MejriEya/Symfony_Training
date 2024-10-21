<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('puublicationDate', null, [
                'widget' => 'signle_text',
            ])
            ->add('published')
            ->add('author' , EntityType::class,[
                'class' => Author::class,
                'choice_label' => 'firstName' ,
                'expanded' => false ,
                'mutiple ' => false
            ])
            ->add('save' , SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'date_class' => Book::class,
        ]);
    }


}

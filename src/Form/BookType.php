<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('editionYears')
            ->add('pagesNumber')
            ->add('codeIsbn')
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => function(Author $author){
                    return "{$author->getFirstname()} {$author->getLastname()}";
                }
            ])
            // ->add('genres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}

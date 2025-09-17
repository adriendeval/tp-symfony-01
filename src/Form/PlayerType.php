<?php

namespace App\Form;

use App\Entity\Player;
use PhpParser\Node\Name;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'label' => 'Nom '
        ]);
        $builder->add('xp', null, [
            'label' => 'XP '
        ]);
        $builder->add('level', null, [
            'label' => 'Niveau '
        ]);
        $builder->add('groups', null, [
            'label' => 'Groupes '
        ]);
        $builder->add('games', null, [
            'label' => 'Parties '
        ]);
        $builder->add('categories', null, [
            'label' => 'Catégories '
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
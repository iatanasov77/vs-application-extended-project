<?php namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Vankosoft\UsersBundle\Form\UserFormType;
use Vankosoft\UsersBundle\Model\UserInterface;
use Vankosoft\UsersBundle\Form\Traits\UserInfoFormTrait;

/*
 * Form Inheritance:
 * https://stackoverflow.com/questions/22414166/inherit-form-or-add-type-to-each-form
 */
class RegistrationForm extends UserFormType
{
    use UserInfoFormTrait;
    
    public function __construct(
        string $dataClass,
        RepositoryInterface $localesRepository,
        RequestStack $requestStack,
        string $applicationClass,
        AuthorizationCheckerInterface $auth
    ) {
        parent::__construct( $dataClass, $localesRepository, $requestStack, $applicationClass, $auth );
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        parent::buildForm( $builder, $options );
        $this->buildUserInfoForm( $builder, $options );
        
        $builder->remove( 'enabled' );
        $builder->remove( 'verified' );
        
        $builder->remove( 'roles_options' );
        $builder->remove( 'applications' );
        $builder->remove( 'username' );
        
        $builder->remove( 'btnSave' );
        
        $builder
            ->setMethod( 'POST' )
            ->add( 'agreeTerms', CheckboxType::class, [
                'label'                 => 'vs_users.form.registration.agreement_text',
                'translation_domain'    => 'VSUsersBundle',
                'mapped'                => false,
            ])
            ->add( 'btnRgister', SubmitType::class, [
                'label' => 'vs_users.form.registration.register',
                'translation_domain' => 'VSUsersBundle'
            ])
            
            ////////////////////////////////////////////////
            // Additional Fields
            ////////////////////////////////////////////////
            ->add( 'birthday', BirthdayType::class, [
                'mapped'        => false,
                'label'         => 'Date of Birth',
                'placeholder'   => [
                    'year'  => 'Year',
                    'month' => 'Month',
                    'day'   => 'Day',
                ],
            ])
            ->add( 'country', CountryType::class, [
                'mapped'        => false,
                'label'         => 'Country',
                'placeholder'   => '-- Select Country --',
            ])
            ->add( 'state', ChoiceType::class, [
                'mapped'        => false,
                'label'         => 'State',
                'placeholder'   => '-- Select State --',
                //'choices'       => \array_flip( \Symfony\Component\IntlSubdivision\IntlSubdivision::getStatesAndProvincesForCountry( 'BG' ) ),
                'choices'       => [],
            ])
            ->add( 'city', TextType::class, [
                'mapped'        => false,
                'label'         => 'City',
            ])
            ->add( 'address', TextType::class, [
                'mapped'        => false,
                'label'         => 'Address',
            ])
            ->add( 'zip', TextType::class, [
                'mapped'        => false,
                'label'         => 'Zip / Postal Code',
            ])
            
            ->add( 'phone', TextType::class, [
                'mapped'        => false,
                'label'         => 'Home Phone',
            ])
            ->add( 'mobile', TextType::class, [
                'mapped'        => false,
                'required'      => false,
                'label'         => 'Mobile Phone',
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver ): void
    {   
        parent::configureOptions( $resolver );
        
        $resolver
            ->setDefaults([
                'csrf_protection'       => true,
                
                'profilePictureMapped'  => false,
                'titleMapped'           => false,
                'firstNameMapped'       => false,
                'lastNameMapped'        => false,
            ])
            ->setDefined([
                'users',
            ])
            ->setAllowedTypes( 'users', UserInterface::class )
        ;
    }

    public function getName()
    {
        return 'vs_users.registration';
    }
}

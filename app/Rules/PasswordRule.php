<?php

namespace App\Rules;

use App\Models\AppParam;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class PasswordRule implements ValidationRule
{
  /**
   * Get user
   */
  protected $user;

  /**
   * If the password requires at least 3 types of characters.
   *
   * @var bool
   */
  protected $numberTypes = 1;

  /**
   * If the password doesn't contain user first name, last name or login.
   *
   * @var bool
   */
  protected $notContainNames = false;

  /**
   * Minimum password length.
   *
   * @var int
   */
  protected $min;

  /**
   * Whether the password must contain mixed case characters.
   *
   * @var bool
   */
  protected $mixedCase;

  /**
   * Whether the password must contain numbers.
   *
   * @var bool
   */
  protected $numbers;

  /**
   * Whether the password must contain symbols.
   *
   * @var bool
   */
  protected $symbols;

  /**
   * Whether the password must contain letters.
   *
   * @var bool
   */
  protected $letters;

  public function __construct($user = null)
  {
    // if ($numberTypes > 0 && $numberTypes <= 5) {
    //   $this->numberTypes = max((int) $numberTypes, 1);
    // }
    $this->user = $user;
    if ($this->user == null) {
      $this->user = auth()->user();
    }

    $this->getDynamicRules(); // Fetch dynamic rules from the database
  }

  /**
   * Makes the password require at least 3 types of characters
   * (3 of 4 types: lowercase, uppercase, numbers, symbols )
   * 
   * @return $this
   */
  public function setNumberOfTypes($size)
  {
    $this->numberTypes = $size;
    return $this;
  }

  /**
   * Check if it doesn't contain user's first name, last name or login
   * 
   * @return $this
   */
  public function notContainNames()
  {
    $this->notContainNames = true;

    return $this;
  }

  /**
   * Fetch dynamic password rules from the database and apply them.
   *
   * @return array
   */
  protected function getDynamicRules(): void
  {
    // Fetch dynamic password rules from the database
    $params = AppParam::where('option_key', 'password_params')->get();

    foreach ($params as $param) {
      switch ($param->option) {
        case 'min_length':
          $this->min = (int) $param->value;
          break;
        case 'not_contain_names':
          $this->notContainNames = (bool) $param->value;
          break;
        case 'number_types':
          $this->numberTypes = (int) $param->value;
          break;
        case 'mixedCase':
          $this->mixedCase = (bool) $param->value;
          break;
        case 'numbers':
          $this->numbers = (bool) $param->value;
          break;
        case 'symbols':
          $this->symbols = (bool) $param->value;
          break;
        case 'letters':
          $this->letters = (bool) $param->value;
          break;
      }
    }
  }

  /**
   * Run the validation rule.
   *
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $passwordRule = Password::min($this->min);
    if ($this->mixedCase === true) {
      $passwordRule->mixedCase();
    }

    if ($this->numbers === true) {
      $passwordRule->numbers();
    }

    if ($this->symbols === true) {
      $passwordRule->symbols();
    }

    if ($this->letters === true) {
      $passwordRule->letters();
    }

    if ($this->numberTypes && $this->numberTypes > 0 && $this->numberTypes <= 4) {
      $characterTypes = 0;
      if (preg_match('/[a-z]/', $value)) {
        $characterTypes++;
      }
      if (preg_match('/[A-Z]/', $value)) {
        $characterTypes++;
      }
      if (preg_match('/[0-9]/', $value)) {
        $characterTypes++;
      }
      if (preg_match('/[^a-zA-Z0-9]/', $value)) {
        $characterTypes++;
      }
      if ($characterTypes < $this->numberTypes) {
        $fail('The :attribute must contain at least ' . $this->numberTypes . ' types of characters.');
      }
    }

    if (
      $this->notContainNames &&
      $this->user !== null &&
      (stripos($value, $this->user['nom']) !== false ||
        stripos($value, $this->user['prenom']) !== false ||
        stripos($value, $this->user['login']) !== false)
    ) {
      $fail('The :attribute must not contain your name or your login.');
    }

    $validator = new Validator(app()->get('translator'), ['password' => $value], ['password' => $passwordRule]);

    if ($validator->fails()) {
      $fail($validator->errors()->first('password'));
    }
  }
}

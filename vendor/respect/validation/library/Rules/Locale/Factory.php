<?php
namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class Factory
{
    /**
     * @return Validatable
     */
    public function bic($countryCode)
    {
        $filteredCountryCode = strtoupper($countryCode);
        switch ($filteredCountryCode) {
            case 'DE':
                return new GermanBic();

            default:
                throw new ComponentException(
                    sprintf(
                        'Cannot provide BIC validation for country "%s"',
                        $countryCode
                    )
                );
        }
    }

    /**
     * @return Validatable
     */
    public function bank($countryCode)
    {
        $filteredCountryCode = strtoupper($countryCode);
        switch ($filteredCountryCode) {
            case 'DE':
                return new GermanBank();

            default:
                throw new ComponentException(
                    sprintf(
                        'Cannot provide bank validation for country "%s"',
                        $countryCode
                    )
                );
        }
    }

    /**
     * @return Validatable
     */
    public function bankAccount($countryCode, $bank)
    {
        $filteredCountryCode = strtoupper($countryCode);
        switch ($filteredCountryCode) {
            case 'DE':
                return new GermanBankAccount($bank);

            default:
                throw new ComponentException(
                    sprintf(
                        'Cannot provide bank account validation for country "%s" and bank "%s"',
                        $countryCode,
                        $bank
                    )
                );
        }
    }
}

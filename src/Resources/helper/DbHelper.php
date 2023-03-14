<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PlatformDemoData\Resources\helper;

use Doctrine\DBAL\Connection;
use Shopware\Core\Defaults;

class DbHelper
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getLanguageId(string $languageCode): ?string
    {
        $localeId = $this->getLocaleId($languageCode);

        if ($localeId === null) {
            return null;
        }

        $result = $this->connection->fetchOne(
            '
                SELECT LOWER(HEX(id))
                FROM language
                WHERE locale_id = UNHEX(:localeId)
            ',
            ['localeId' => $localeId]
        );

        if ($result === false) {
            return null;
        }

        return $result;
    }

    public function getSystemLanguageCode(): string
    {
        $systemLanguageLocaleId = $this->connection->fetchOne(
            '
                SELECT LOWER(HEX(locale_id))
                FROM language
                WHERE id = UNHEX(:systemLanguageId)
            ',
            ['systemLanguageId' => Defaults::LANGUAGE_SYSTEM]
        );

        if ($systemLanguageLocaleId === false) {
            throw new \RuntimeException('Could not find the localeID of the SystemLanguage!');
        }

        $systemLanguageCode = $this->connection->fetchOne(
            '
                SELECT code
                FROM locale
                WHERE id = UNHEX(:systemLanguageLocaleId)
            ',
            ['systemLanguageLocaleId' => $systemLanguageLocaleId]
        );

        if ($systemLanguageCode === false) {
            throw new \RuntimeException('The locale of the SystemLanguage could not be found');
        }

        return $systemLanguageCode;
    }

    private function getLocaleId(string $languageCode): ?string
    {
        $result = $this->connection->fetchOne(
            '
                SELECT LOWER(HEX(id))
                FROM locale
                WHERE code = :languageCode
            ',
            ['languageCode' => $languageCode]
        );

        if ($result === false) {
            return null;
        }

        return (string) $result;
    }
}

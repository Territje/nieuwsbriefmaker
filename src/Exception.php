<?php
/*
 * PHPMailer Exception class.
 * PHP Version 5.5
 *
 * @author    Terri O'Donovan
 * @copyright 2021 Terri O'Donovan
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace Terri\nieuwsbriefmaker;

/**
 * Bolt nieuwsbrief maker.
 */
class Extension extends BaseExtension
{
    public function getName(): string
    {
        return 'My Awesome Extension';
    }
}

<?php

namespace Bolt\Extension\Softer\Nieuwsbriefmaker\Tests;

use Bolt\Tests\BoltUnitTest;
use Bolt\Extension\Softer\Nieuwsbriefmaker\NieuwsbriefmakerExtension;

/**
 * Nieuwsbriefmaker testing class.
 *
 * @author SofTer <you@example.com>
 */
class ExtensionTest extends BoltUnitTest
{
    /**
     * Ensure that the Nieuwsbriefmaker extension loads correctly.
     */
    public function testExtensionBasics()
    {
        $app = $this->getApp(false);
        $extension = new NieuwsbriefmakerExtension($app);

        $name = $extension->getName();
        $this->assertSame($name, 'Nieuwsbriefmaker');
        $this->assertInstanceOf('\Bolt\Extension\ExtensionInterface', $extension);
    }

    public function testExtensionComposerJson()
    {
        $composerJson = json_decode(file_get_contents(dirname(__DIR__) . '/composer.json'), true);

        // Check that the 'bolt-class' key correctly matches an existing class
        $this->assertArrayHasKey('bolt-class', $composerJson['extra']);
        $this->assertTrue(class_exists($composerJson['extra']['bolt-class']));

        // Check that the 'bolt-assets' key points to the correct directory
        $this->assertArrayHasKey('bolt-assets', $composerJson['extra']);
        $this->assertSame('web', $composerJson['extra']['bolt-assets']);
    }
}

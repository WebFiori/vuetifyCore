<?php

namespace themes\vuetifyCore;

use webfiori\framework\App;
use webfiori\framework\ui\WebPage;
use webfiori\ui\HeadNode;
use webfiori\ui\HTMLNode;
use webfiori\ui\JsCode;
/**
 * A base class that represents a &lt;head&gt; tag.
 * 
 * The class is intended for use when creating themes which are based on vue and vuetify.
 *
 */
class CommonHead extends HeadNode {
    private $googleSiteVerification;
    private $gtm;
    /**
     * Creates new instance of the class.
     */
    public function __construct(WebPage $page) {
        parent::__construct();
        $this->addJs('https://unpkg.com/ajaxrequest-helper@2.1.9/AJAXRequest.js', [
            'integrity' => "sha256-s9Ds9XxJtxeXIpTz5boTwnVxkYJ6lQ/SlkqNsebuCjQ=",
            'crossorigin' => "anonymous",
            'id' => 'ajaxrequest-helper'
        ]);

        $this->addLink('icon', App::getConfig()->getBaseURL().'/favicon.ico', [
            'id' => 'favicon'
        ]);
        $this->addCSS('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900');
        $this->addCSS('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css', [
            'integrity' => "sha256-A/48q6BeZbFOQDUTnu6JsSvofNC880KsOIZ3Duw6mWI=",
            'crossorigin' => "anonymous",
            'id' => 'MaterialDesign-Webfont'
        ]);

        if (!(defined('TESTING') && TESTING) && !(defined('STAGING') && STAGING)) {
            $page->addBeforeRender(function (WebPage $p) {
                
                $head = $p->getDocument()->getHeadNode();
                $gtmId = $head->getGTM();
                
                if ($gtmId !== null) {
                    $p->removeChild('google-tag-manager');
                    $p->removeChild('google-tag-manager-noscript');
                    $gtmCode = new JsCode();
                    $gtmNonce = hash('sha256', microtime().''. random_bytes(10));
                    $gtmCode->setAttributes([
                        'id' => 'google-tag-manager',
                        'nonce' => $gtmNonce
                    ]);
                    $gtmCode->addCode(""
                            . "(function(w, d, s, l, i) {\n"
                            . "    w[l] = w[l] || [];\n"
                            . "    w[l].push({\n"
                            . "        'gtm.start': new Date().getTime(),\n"
                            . "        event: 'gtm.js'\n"
                            . "    });\n"
                            . "    var f = d.getElementsByTagName(s)[0],\n"
                            . "        j = d.createElement(s),\n"
                            . "        dl = l != 'dataLayer' ? '&l=' + l : '';\n"
                            . "    j.async = true;\n"
                            . "    j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;\n"
                            . "    var n = d.querySelector('[nonce]');\n"
                            . "    n && j.setAttribute('nonce', n.nonce || n.getAttribute('nonce'));\n"
                            . "    f.parentNode.insertBefore(j, f);"
                            . "    })(window, document, 'script', 'dataLayer', '$gtmId');\n");


                    $head->addChild($gtmCode);
                    $noScriptGtm = new HTMLNode('noscript', [
                        'id' => 'google-tag-manager-noscript'
                    ]);
                   
                    $noScriptGtm->addChild('iframe', [
                        'src' => "https://www.googletagmanager.com/ns.html?id=$gtmId",
                        'height' => "0",
                        'width' => "0",
                        'style' => "display:none;visibility:hidden"
                    ]);
                    $p->getDocument()->getBody()->insert($noScriptGtm, 0);

                }
                
                $searchConsoleID = $head->getGoogleSiteVerification();
                
                if ($searchConsoleID !== null) {
                    $head->addMeta('google-site-verification', $searchConsoleID);
                }
                
            },100);
        };
    }
    /**
     * Returns Google Tag Manager container ID.
     * 
     * A container is a collection of tags, triggers, variables, and related
     * configurations installed on a given website or mobile app
     * 
     * @return string
     */
    public function getGTM() {
        return $this->gtm;
    }
    /**
     * Returns Google search console verification code.
     * 
     * @return string
     */
    public function getGoogleSiteVerification() {
        return $this->googleSiteVerification;
    }
    /**
     * Sets Google Tag Manager container ID.
     * 
     * This code is used to link a website with Google Tag manager.
     * 
     * @param string $code
     */
    public function setGTM(string $code) {
        $this->gtm = $code;
    }
    /**
     * Sets Google search console verification code.
     * 
     * This code is used to verify ownership of a domain in Google search console.
     * 
     * @param string $code
     */
    public function setGoogleSiteVerification(string $code) {
        $this->googleSiteVerification = $code;
    }
}


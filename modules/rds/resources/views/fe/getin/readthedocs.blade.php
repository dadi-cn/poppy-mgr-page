<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor: A Process Control System &mdash; Supervisor 3.3.1 documentation</title>
    <link rel="stylesheet" href="/assets/css/3rd/font-awesome.css" type="text/css"/>
    <link rel="stylesheet" href="/project/lemon/css/readthedocs.css" type="text/css"/>
    <link rel="top" title="Supervisor 3.3.1 documentation" href="#"/>
    <link rel="next" title="Introduction" href="introduction.html"/>
    @include('lemon.inc.requirejs')
</head>

<body class="wy-body-for-nav" role="document">

<div class="wy-grid-for-nav">


    <nav data-toggle="wy-nav-shift" class="wy-nav-side">
        <div class="wy-side-scroll">
            <div class="wy-side-nav-search">


                <a href="#" class="icon icon-home"> Supervisor


                </a>


                <div class="version">
                    3.3.1
                </div>


                <div role="search">
                    <form id="rtd-search-form" class="wy-form" action="search.html" method="get">
                        <input type="text" name="q" placeholder="Search docs"/>
                        <input type="hidden" name="check_keywords" value="yes"/>
                        <input type="hidden" name="area" value="default"/>
                    </form>
                </div>


            </div>

            <div class="wy-menu wy-menu-vertical" data-spy="affix" role="navigation" aria-label="main navigation">


                <ul>
                    <li class="toctree-l1"><a class="reference internal" href="introduction.html">Introduction</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="installing.html">Installing</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="running.html">Running Supervisor</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="configuration.html">Configuration
                            File</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="subprocess.html">Subprocesses</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="logging.html">Logging</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="events.html">Events</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="xmlrpc.html">Extending Supervisor&#8217;s
                            XML-RPC API</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="upgrading.html">Upgrading Supervisor 2 to
                            3</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="faq.html">Frequently Asked Questions</a>
                    </li>
                    <li class="toctree-l1"><a class="reference internal" href="development.html">Resources and
                            Development</a></li>
                    <li class="toctree-l1"><a class="reference internal" href="glossary.html">Glossary</a></li>
                </ul>
                <ul>
                    <li class="toctree-l1"><a class="reference internal" href="api.html">XML-RPC API Documentation</a>
                    </li>
                </ul>
                <ul>
                    <li class="toctree-l1"><a class="reference internal" href="plugins.html">Third Party Applications
                            and Libraries</a></li>
                </ul>
                <ul>
                    <li class="toctree-l1"><a class="reference internal" href="changes.html">Changelog</a></li>
                </ul>


            </div>
        </div>
    </nav>

    <section data-toggle="wy-nav-shift" class="wy-nav-content-wrap">


        <nav class="wy-nav-top" role="navigation" aria-label="top navigation">
            <i data-toggle="wy-nav-top" class="fa fa-bars"></i>
            <a href="#">Supervisor</a>
        </nav>


        <div class="wy-nav-content">
            <div class="rst-content">


                <div role="navigation" aria-label="breadcrumbs navigation">
                    <ul class="wy-breadcrumbs">
                        <li><a href="#">Docs</a> &raquo;</li>

                        <li>Supervisor: A Process Control System</li>
                        <li class="wy-breadcrumbs-aside">


                            <a href="_sources/index.txt" rel="nofollow"> View page source</a>


                        </li>
                    </ul>
                    <hr/>
                </div>
                <div role="main" class="document" itemscope="itemscope" itemtype="http://schema.org/Article">
                    <div itemprop="articleBody">

                        <div class="section" id="supervisor-a-process-control-system">
                            <h1>Supervisor: A Process Control System<a class="headerlink"
                                                                       href="#supervisor-a-process-control-system"
                                                                       title="Permalink to this headline">¶</a></h1>
                            <p>Supervisor is a client/server system that allows its users to monitor
                                and control a number of processes on UNIX-like operating systems.</p>
                            <p>It shares some of the same goals of programs like <a class="reference internal"
                                                                                    href="glossary.html#term-launchd"><em
                                            class="xref std std-term">launchd</em></a>,
                                <a class="reference internal" href="glossary.html#term-daemontools"><em
                                            class="xref std std-term">daemontools</em></a>, and <a
                                        class="reference internal" href="glossary.html#term-runit"><em
                                            class="xref std std-term">runit</em></a>. Unlike some of these programs,
                                it is not meant to be run as a substitute for <tt class="docutils literal"><span
                                            class="pre">init</span></tt> as &#8220;process id
                                1&#8221;. Instead it is meant to be used to control processes related to a
                                project or a customer, and is meant to start like any other program at
                                boot time.</p>
                            <div class="section" id="narrative-documentation">
                                <h2>Narrative Documentation<a class="headerlink" href="#narrative-documentation"
                                                              title="Permalink to this headline">¶</a></h2>
                                <div class="toctree-wrapper compound">
                                    <ul>
                                        <li class="toctree-l1"><a class="reference internal" href="introduction.html">Introduction</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="introduction.html#overview">Overview</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="introduction.html#features">Features</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="introduction.html#supervisor-components">Supervisor
                                                        Components</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="introduction.html#platform-requirements">Platform
                                                        Requirements</a></li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal" href="installing.html">Installing</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="installing.html#installing-to-a-system-with-internet-access">Installing
                                                        to A System With Internet Access</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="installing.html#installing-to-a-system-without-internet-access">Installing
                                                        To A System Without Internet Access</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="installing.html#installing-a-distribution-package">Installing
                                                        a Distribution Package</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="installing.html#installing-via-pip">Installing
                                                        via pip</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="installing.html#creating-a-configuration-file">Creating
                                                        a Configuration File</a></li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal" href="running.html">Running
                                                Supervisor</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="running.html#adding-a-program">Adding a
                                                        Program</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="running.html#running-supervisord">Running
                                                        <strong class="program">supervisord</strong></a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="running.html#running-supervisorctl">Running
                                                        <strong class="program">supervisorctl</strong></a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="running.html#signals">Signals</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="running.html#runtime-security">Runtime
                                                        Security</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="running.html#running-supervisord-automatically-on-startup">Running
                                                        <strong class="program">supervisord</strong> automatically on
                                                        startup</a></li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal" href="configuration.html">Configuration
                                                File</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#file-format">File
                                                        Format</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#unix-http-server-section-settings"><tt
                                                                class="docutils literal"><span class="pre">[unix_http_server]</span></tt>
                                                        Section Settings</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#inet-http-server-section-settings"><tt
                                                                class="docutils literal"><span class="pre">[inet_http_server]</span></tt>
                                                        Section Settings</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#supervisord-section-settings"><tt
                                                                class="docutils literal"><span
                                                                    class="pre">[supervisord]</span></tt> Section
                                                        Settings</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#supervisorctl-section-settings"><tt
                                                                class="docutils literal"><span class="pre">[supervisorctl]</span></tt>
                                                        Section Settings</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#program-x-section-settings"><tt
                                                                class="docutils literal"><span
                                                                    class="pre">[program:x]</span></tt> Section Settings</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#include-section-settings"><tt
                                                                class="docutils literal"><span
                                                                    class="pre">[include]</span></tt> Section
                                                        Settings</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#group-x-section-settings"><tt
                                                                class="docutils literal"><span
                                                                    class="pre">[group:x]</span></tt> Section
                                                        Settings</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#fcgi-program-x-section-settings"><tt
                                                                class="docutils literal"><span class="pre">[fcgi-program:x]</span></tt>
                                                        Section Settings</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#eventlistener-x-section-settings"><tt
                                                                class="docutils literal"><span class="pre">[eventlistener:x]</span></tt>
                                                        Section Settings</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="configuration.html#rpcinterface-x-section-settings"><tt
                                                                class="docutils literal"><span class="pre">[rpcinterface:x]</span></tt>
                                                        Section Settings</a></li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal" href="subprocess.html">Subprocesses</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="subprocess.html#nondaemonizing-of-subprocesses">Nondaemonizing
                                                        of Subprocesses</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="subprocess.html#pidproxy-program"><strong
                                                                class="program">pidproxy</strong> Program</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="subprocess.html#subprocess-environment">Subprocess
                                                        Environment</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="subprocess.html#process-states">Process
                                                        States</a></li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal"
                                                                  href="logging.html">Logging</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="logging.html#activity-log">Activity
                                                        Log</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="logging.html#child-process-logs">Child
                                                        Process Logs</a></li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal"
                                                                  href="events.html">Events</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="events.html#event-listeners-and-event-notifications">Event
                                                        Listeners and Event Notifications</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="events.html#event-types">Event Types</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal" href="xmlrpc.html">Extending
                                                Supervisor&#8217;s XML-RPC API</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="xmlrpc.html#configuring-xml-rpc-interface-factories">Configuring
                                                        XML-RPC Interface Factories</a></li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal" href="upgrading.html">Upgrading
                                                Supervisor 2 to 3</a></li>
                                        <li class="toctree-l1"><a class="reference internal" href="faq.html">Frequently
                                                Asked Questions</a></li>
                                        <li class="toctree-l1"><a class="reference internal" href="development.html">Resources
                                                and Development</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="development.html#mailing-lists">Mailing
                                                        Lists</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="development.html#bug-tracker">Bug
                                                        Tracker</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="development.html#version-control-repository">Version
                                                        Control Repository</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="development.html#contributing">Contributing</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="development.html#author-information">Author
                                                        Information</a></li>
                                            </ul>
                                        </li>
                                        <li class="toctree-l1"><a class="reference internal" href="glossary.html">Glossary</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="section" id="api-documentation">
                                <h2>API Documentation<a class="headerlink" href="#api-documentation"
                                                        title="Permalink to this headline">¶</a></h2>
                                <div class="toctree-wrapper compound">
                                    <ul>
                                        <li class="toctree-l1"><a class="reference internal" href="api.html">XML-RPC API
                                                Documentation</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="api.html#status-and-control">Status and
                                                        Control</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="api.html#process-control">Process
                                                        Control</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="api.html#process-logging">Process
                                                        Logging</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="api.html#system-methods">System
                                                        Methods</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="section" id="plugins">
                                <h2>Plugins<a class="headerlink" href="#plugins"
                                              title="Permalink to this headline">¶</a></h2>
                                <div class="toctree-wrapper compound">
                                    <ul>
                                        <li class="toctree-l1"><a class="reference internal" href="plugins.html">Third
                                                Party Applications and Libraries</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="plugins.html#dashboards-and-tools-for-multiple-supervisor-instances">Dashboards
                                                        and Tools for Multiple Supervisor Instances</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="plugins.html#third-party-plugins-and-libraries-for-supervisor">Third
                                                        Party Plugins and Libraries for Supervisor</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="plugins.html#libraries-that-integrate-third-party-applications-with-supervisor">Libraries
                                                        that integrate Third Party Applications with Supervisor</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="section" id="release-history">
                                <h2>Release History<a class="headerlink" href="#release-history"
                                                      title="Permalink to this headline">¶</a></h2>
                                <div class="toctree-wrapper compound">
                                    <ul>
                                        <li class="toctree-l1"><a class="reference internal" href="changes.html">Changelog</a>
                                            <ul>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id1">3.3.1 (2016-08-02)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id2">3.3.0 (2016-05-14)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id3">3.2.3 (2016-03-19)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id4">3.2.2 (2016-03-04)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id5">3.2.1 (2016-02-06)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id6">3.2.0 (2015-11-30)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id7">3.1.3 (2014-10-28)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id8">3.1.2 (2014-09-07)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id9">3.1.1 (2014-08-11)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id10">3.1.0
                                                        (2014-07-29)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id11">3.0 (2013-07-30)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#b2-2013-05-28">3.0b2
                                                        (2013-05-28)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#b1-2012-09-10">3.0b1
                                                        (2012-09-10)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a12-2011-12-06">3.0a12
                                                        (2011-12-06)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a11-2011-12-06">3.0a11
                                                        (2011-12-06)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a10-2011-03-30">3.0a10
                                                        (2011-03-30)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a9-2010-08-13">3.0a9
                                                        (2010-08-13)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a8-2010-01-20">3.0a8
                                                        (2010-01-20)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a7-2009-05-24">3.0a7
                                                        (2009-05-24)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a6-2008-04-07">3.0a6
                                                        (2008-04-07)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a5-2008-03-13">3.0a5
                                                        (2008-03-13)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a4-2008-01-30">3.0a4
                                                        (2008-01-30)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a3-2007-10-02">3.0a3
                                                        (2007-10-02)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a2-2007-08-24">3.0a2
                                                        (2007-08-24)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#a1-2007-08-16">3.0a1
                                                        (2007-08-16)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#b1-2007-03-31">2.2b1
                                                        (2007-03-31)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id12">2.1 (2007-03-17)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#b1-2006-08-30">2.1b1
                                                        (2006-08-30)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id13">2.0 (2006-08-30)</a>
                                                </li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#b1-2006-07-12">2.0b1
                                                        (2006-07-12)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id14">1.0.7
                                                        (2006-07-11)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id15">1.0.6
                                                        (2005-11-20)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#id16">1.0.5
                                                        (2004-07-29)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#or-alpha-4-2004-06-30">1.0.4
                                                        or &#8220;Alpha 4&#8221; (2004-06-30)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#or-alpha-3-2004-05-26">1.0.3
                                                        or &#8220;Alpha 3&#8221; (2004-05-26)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#or-alpha-2-unreleased">1.0.2
                                                        or &#8220;Alpha 2&#8221; (Unreleased)</a></li>
                                                <li class="toctree-l2"><a class="reference internal"
                                                                          href="changes.html#or-alpha-1-unreleased">1.0.0
                                                        or &#8220;Alpha 1&#8221; (Unreleased)</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="section" id="indices-and-tables">
                                <h2>Indices and tables<a class="headerlink" href="#indices-and-tables"
                                                         title="Permalink to this headline">¶</a></h2>
                                <ul class="simple">
                                    <li><a class="reference internal" href="genindex.html"><em>Index</em></a></li>
                                    <li><a class="reference internal" href="py-modindex.html"><em>Module Index</em></a>
                                    </li>
                                    <li><a class="reference internal" href="search.html"><em>Search Page</em></a></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
                <footer>

                    <div class="rst-footer-buttons" role="navigation" aria-label="footer navigation">

                        <a href="introduction.html" class="btn btn-neutral float-right" title="Introduction"
                           accesskey="n">Next <span class="fa fa-arrow-circle-right"></span></a>


                    </div>


                    <hr/>

                    <div role="contentinfo">
                        <p>
                            &copy; Copyright 2004-2016, Agendaless Consulting and Contributors.
                            Last updated on Sep 03, 2016.

                        </p>
                    </div>
                    Built with <a href="http://sphinx-doc.org/">Sphinx</a> using a <a
                            href="https://github.com/snide/sphinx_rtd_theme">theme</a> provided by <a
                            href="https://readthedocs.org">Read the Docs</a>.

                </footer>

            </div>
        </div>

    </section>

</div>

<script>
    var DOCUMENTATION_OPTIONS = {
        URL_ROOT      : './',
        VERSION       : '3.3.1',
        COLLAPSE_INDEX: false,
        FILE_SUFFIX   : '.html',
        HAS_SOURCE    : true
    };
    requirejs(['jquery', 'underscore', 'modernizr', 'lemon/readthedocs/doctools', 'lemon/readthedocs/theme'], function ($) {

        $(function () {
            SphinxRtdTheme.StickyNav.enable();
        })
    })
</script>
</body>
</html>
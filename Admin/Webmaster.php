<?php
/*
* Admin/Webmaster.php
* LHS Math Club Website
*
* Contains information for site Webmasters.
*/

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


show_page();





function show_page() {
	page_header('Webmaster Guide');
	echo <<<HEREDOC
      <h1>Webmaster Guide</h1>
      
      <h3>Introduction</h3>
      <p>Welcome! If you're reading this, you must be the new webmaster for the Lexington High School
      Math Club. This document summarizes your responsibilities and explains how to manage the
      site. The first thing you should do is print a copy of this page and put it somewhere safe.
      After that, take a look around the Admin portion of the site.
      </p>
      
      <h3>Responsibilites</h3>
      <ul>
        <li><span class="b">Back up the website weekly.</span> After every Math Club meeting, log
        in and go to the &quot;Database&quot; page. Click <span class="i">Generate Backup</span>,
        then <span class="i">Download All Content</span>. Save the ZIP file to a safe place on your
        computer, then upload a copy to the Webmasters' Dropbox (which should have been shared with
        you when you became webmaster). You may delete old database backups from the website (at the
        bottom of &quot;Files&quot;), but keep all the ZIP files around for a year. Beyond that, please
        retain all year-end backups (the last ones, taken in June).<br /><br /></li>
        
        <li><span class="b">Help out the Captains.</span> The controls on this site are mostly self-explanitory.
        If a captain needs help with something, you can hopefully figure it out.<br />
        <br /></li>
        
        <li><span class="b">Help out users.</span> The webmaster email address is listed on the contact
        page and on almost every message sent by the website. If people need help from an Admin, they'll
        contact you.<br /><br /></li>
        
        <li><span class="b">Graduating Alumni.</span> After the end-of-year ceremony, go to "Alumni" and
        click the button. Then back up the site.<br /><br /></li>
        
        <li><span class="b">Assigning Captains.</span> You are responsible for graduating old captains and
        elevating new ones. Please notify captains that their contact information is visible to all
        members, remind them to keep members' email addresses strictly confidential, and set up a mail forwarder
        for them. To do this, log in to Gmail as webmaster@lhsmath.org and edit the mail filters. Each
        captain should have a rule that forwards them mail addressed to <a href="">(name)@lhsmath.org</a> and
        <a href="mailto:captains@lhsmath.org">captains@lhsmath.org</a>. One captain should also recieve
        mail for <a href="mailto:contact@lhsmath.org">contact@lhsmath.org</a> and
        <a href="mailto:lmt@lhsmath.org">lmt@lhsmath.org</a>.<br /><br /></li>
        
        <li><span class="b">Renewing Payment.</span> You should receive an email alert when the website is
        running low on funds. To load more, log in to the NearlyFreeSpeech.NET control panel and refill the
        account with money via PayPal (talk to Mr. Roos about getting money). Please be aware that you will
        also need to renew the domain name periodically. The site draws between $25 and $35 a year, including
        domain registration costs.<br /><br /></li>
        
        <li><span class="b">Picking a Successor.</span> When you are in your Senior year, choose one Freshman
        or Sophomore to be the next System Administrator. During this year, they should start to take over from
        you and learn their way around the site. First, share the Webmasters' Dropbox with them. Before you graduate,
        change the mail forwarders so that they receive webmaster emails.<br /><br /></li>
      </ul>
      
      <h3>Dealing with Abuse</h3>
      <p>The site has several features built in to deal with abuse. IP addresses are blocked for 10 minutes
      after 10 incorrect login attempts (per email address). This control is designed to prevent guessing
      while not allowing the school's entire subnet to be locked out at once. You can check the number of
      failed logins per IP and account in &quot;Login Log.&quot; More information is logged to the database
      table <span class="monospace">login_attempts</span>. Banned users are also logged. To block an IP address
      from accessing the site entirely, edit the Config file (see next section).</p>
      
      <h3>Recovering Control</h3>
      <p>If all Admins lose access to the site, you can use the Super-Admin account to restore your account.
      To activate this feature, you will need to edit the Config file. First, log in to the server
      via SFTP. If you don't have a client, try <a href="http://winscp.net/">WinSCP</a>. Then, navigate to
      <span class="monospace">/home/public/lib</span> and edit the file <span class="monospace">CONFIG.php</span>.
      Find the section titled <span class="i">Super-Admin Feature</span> and follow the directions. Your
      User ID is listed at the bottom of this page. Make sure to disable Super-Admin when you're done!</p>
      
      <h3>The &quot;No&quot; List</h3>
      <p>Please follow these guidelines when managing the site:</p>
      <ul>
        <li>Guard the password list very carefully. Share it with as few people as possible.<br /><br /></li>
        
        <li>Respect users' privacy. Never give out anyone's personal information. Don't look at test scores
        unless you have to. Information not accessible to all members should be treated as strictly
        confidential. Also, do your best to prevent the Captains from spamming everyone.<br /><br /></li>
        
        <li>You can play around with the site as long as you take responsibility when you break stuff,
        but <span class="i">please</span>, don't use Math Club hosting to run your own websites or anything.
        Mr. Roos is ultimately responsible for all content on this site.<br /><br /></li>
      </ul>
      
      <h3>For Developers</h3>
      <p>If you would like to improve upon the Math Club website, feel free! You can examine the code see how the
      site works - a good starting point is <span class="monospace">Account/Register.php</span>. Note the code
      at the top - just about every page starts like this. If you set up a local test environment (never test
      code on the proudction server!), use <span class="monospace">CONFIG.local.php</span> to override
      configuration values. Also, note that the site depends on PEAR Mail and possibly some other packages.</p>
      
      <h3>LMT</h3>
      <p>Running the LMT is considerably more involved. The best way to do this is probably to be trained by the last
      Tech Czar. Knowing PHP is a must (just for the Guts round - I can help with this if you need
      me to). Edit <span class="monospace">lib/lmt-scoring.php</span>, and mind the preconditions and posconditions!
      Content on the public part of the LMT website is updated through the web interface. Please write in valid XHTML 1.0!</p>
      
      <h3>Help!</h3>
      <p>If anything comes up, I would be happy to help. Just email me at <a href="mailto:dev@tidor.net">dev@tidor.net</a>.
      <br /><br />Your User ID is: <span class="b">{$_SESSION['user_id']}</span>.</p>
      
      <p><br /><br /><br /><img src="http://imgs.xkcd.com/comics/devotion_to_duty.png" title="The weird sense of duty really good sysadmins have can border on the sociopathic, but it&#39;s nice to know that it stands between the forces of darkness and your cat blog&#39;s servers." alt="XCDK #705: Devotion to Duty" /></p>
HEREDOC;
	go_home_footer();
}

?>
<?php
/*
* Admin/Captains.php
* LHS Math Club Website
*
* Contains information for Captains.
*/

require_once '../lib/functions.php';
restrict_access('A');

page_title('Captains Guide');
?>
  <h1><small style="color:red">[under construction]</small> Captains Guide to the Website</h1>
	<p>Welcome! If you're reading this, you must be a new captain for the Lexington High School
	Math Club. LHSMATH.org is designed to make your captaining experience as logistically simple as possible.
	Usually, it's completely self-explanatory, but at times this massive amount of PHP code can exhibit
	rather confusing behavior. Hence, this guide.</p>
	
	[[common things that go wrong]]
  
  <h3>
	Putting the LMT together.
  
  <h3>Scoring and Test Management.</h3>
	Explore 
	
	
  
  <h3 id="Emails">Emails</h3>
	Remember that as captain your email will be displayed <a href="../Contact">on the website</a>, to all team members. You will also be contactable by captains@lhsmath.org, lmt@lhsmath.org, or a number of other emails depending on how the email filters are set up.

	[[Figure out a way to do captains@lhsmath.org emails, as it's the most contacted email on the site.]]
  
  <h3 id="BBCode">BBCode</h3>
  Here is a list of BBCode that you can use in your text formatting for most purposes on the website.
  <pre>
<?php
	$bbString = "[b]this is bold[/b]
	[i]this is italic[/i]
	[u]this is underlined[/u]
	[img]url of image[/img]
	[url]url of website[/url]
	[url=url of website]some label[/url]
	[email]email address[/email]
	[heading]title[/heading]
	[subheading]subtitle[/subheading]
	[bullets]
		[item]item 1 of list[/item]
		[item]item 2 of list[/item]
	[/bullets]
	[pi] displays pi symbol
	[sqrt] displays sqrt symbol";
	echo $bbString;
?>
  </pre>
  
  which will display as
  <br>
  <br>
  <div style="background-color:white;border:dashed 1px black;padding:50px;">
	<?=BBCode($bbString)?>
  </div>
  <br>
  <br>
  <p>
	And that's it! Good luck with captainhood, don't mess up, and always, always do math.
  </p>
  <br>
  <h3>Cheers!</h3>
  ~<a href="Webmaster#Cheers">LHS Math Webmasters</a>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <h3>Introduction</h3>

  
  <h3>Responsibilities</h3>
  <ul>
	<li><span class="b">New Captains/Club Advisors.</span> You are responsible for graduating old captains/advisors and
	elevating new ones. Please notify captains/advisors that their contact information is visible to all
	members, remind them to keep members' email addresses strictly confidential, and set up a mail forwarder
	for them. To do this, log in to Gmail as webmaster@lhsmath.org and edit the mail filters.
	<ul>
		<li>All Captains: <span class="monospace">(name)@lhsmath.org</span>, <span class="monospace">captains@lhsmath.org</span>.</li>
		<li>Some captain (doesn't matter who): <span class="monospace">contact@lhsmath.org</span>, 
			<span class="monospace">lmt@lhsmath.org</span><li>
		<li>Advisor(s): <span class="monospace">(name)@lhsmath.org</span>, <span class="monospace">advisor@lhsmath.org</span>. 
			Perhaps captains@lhsmath.org if they wish.</li>
		<li>Webmaster(s): <span class="monospace">(name)@lhsmath.org</span>, <span class="monospace">webmaster@lhsmath.org</span>, 
			<span class="monospace">mailbot@lhsmath.org</span>, and perhaps others if you wish.</li>
	</ul>
	
	<li><span class="b">Renewing Payment.</span> You should receive an email alert when the website is
	running low on funds. To load more, log in to the 
	<a href="http://members.nearlyfreespeech.net/">NearlyFreeSpeech.NET control panel</a> and refill the
	account with money via PayPal or other methods (talk to the club advisor about getting money). 
	Please be aware that you will also need to renew the domain name periodically. The site draws between 
	$25 and $35 a year, including domain registration costs.<br /><br /></li>
	
	<li><span class="b">Picking a Successor.</span> When you are in your Senior year, choose someone to be the next admin. 
	They should start to take over and learn their way around the site. Share the Webmasters' Dropbox with them, 
	change the mail forwarders so that they receive webmaster emails, and make sure everything on this page makes sense.<br /><br /></li>
  </ul>
  
  
	Respect users' privacy. Never give out anyone's personal information. Don't look at test scores
	unless you have to. Information not accessible to all members should be treated as strictly
	confidential. Also, do your best to prevent the Captains from spamming everyone.
	
  
  <h3>LMT</h3>
  <p>Running the LMT is considerably more involved. The best way to do this is probably to be trained by the last
  Tech Czar. Knowing PHP is a must (just for the Guts round - I can help with this if you need
  me to). Edit <span class="monospace">lib/lmt-scoring.php</span>, and mind the preconditions and posconditions!
  Content on the public part of the LMT website is updated through the web interface (in database rather than files). 
  Please write in <a href="http://validator.w3.org/">valid XHTML 1.0</a> for those pages!</p>
  
  <h3>Help!</h3>
  <p>Webmastering is hard. If anything comes up, we're happy to help. Just email any of us who have listed our emails below.</p>
  
  <p><br /><br /><br /><img src="http://imgs.xkcd.com/comics/devotion_to_duty.png" title="The weird sense of duty really good sysadmins have can border on the sociopathic, but it&#39;s nice to know that it stands between the forces of darkness and your cat blog&#39;s servers." alt="XCDK #705: Devotion to Duty" /></p>
  
  <br />
  <br />
  <h3>Cheers!~</h3>
  <div class="small">
  <p><span class="b">Benjamin Tidor</span> (<a href="mailto:dev@tidor.net">dev@tidor.net</a>): original developer & webmaster to 2012</p>
  <p><span class="b">Peijin Zhang</span>: webmaster 2012-2013</p>
  <p><span class="b">Clive Chan</span> (<a href="mailto:cchan3141@gmail.com">cchan3141@gmail.com</a>): developer & webmaster 2013-2016</p>
  </div>
<?php
?>
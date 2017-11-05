<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visit my Factory</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/drop_menu.css" />

<!--for flag-->

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<!-- </msdropdown> -->

<link rel="stylesheet" type="text/css" href="css/skin2.css" />
<link rel="stylesheet" type="text/css" href="css/flags.css" />
<!--flag end-->
<link rel="Icon" href="images/icon/favicon.ico" type="image/x-icon"  />
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/event.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen" />


<!--for tab-->
<script type="text/javascript">

    $(document).ready(function () {

        //Default Action
        $(".tab_content").hide(); //Hide all content
        $("ul.tabs li:first").addClass("active").show(); //Activate first tab
        $(".tab_content:first").show(); //Show first tab content

        //On Click Event
        $("ul.tabs li").click(function () {
            $("ul.tabs li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content").hide(); //Hide all tab content
            var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            $(activeTab).fadeIn(); //Fade in the active content
            return false;
        });

    });
</script>

 
</head>

<body>
<?php 
    session_start();
	require_once("includes/utilities/database_utilities/database_connection.php");
	include("query.php");
	require_once("includes/utilities/database_utilities/queries.php");
	
	include("user.php");
	require_once("includes/user_classes/company_representative.php");
	require_once("includes/user_classes/visitor.php");
	
	$db_obj = new Database();
	$db_obj->connect_to_the_server(); // Consider using a singleton
	$db_obj->create_database();
	$db_obj->select_database();
	$db_obj->create_tables();	     
	$selection_obj = new SelectQuery();
	$insertion_obj = new InsertionQuery();
?>

    <!--start header-->
    <?php 
      
	  if(isset($_SESSION['user_id'])){
          require_once "includes/header.php"; 
	  }else{
	      require_once "includes/header_b.php";
	  }
	?>
    <!--end header-->

<div class="clear"></div>
<div class="wreper">
<div class="content">
<h2>Terms and Conditions</h2>
<div class="column_left1">
<ul class="tabs"> 
        <li><a href="#tab1">General Conditions
</a></li>
      <li><a href="#tab2">Description of controlled services</a></li>
      <li><a href="#tab3">Financial conditions</a></li>
      <li><a href="#tab4">Conclusion of contract</a></li>
       <li><a href="#tab5">Duration and renewal of the contract</a></li> 
        <li><a href="#tab6">Execution of contract</a></li> 
        <li><a href="#tab7">Inexecution of contract</a></li> 
        <li><a href="#tab8">Resolution of contract</a></li> 
        <li><a href="#tab9">Settlement of disputes</a></li>    

    </ul>
    </div>
<div class="column_right1">
<div class="tab_container">
        <div id="tab1" class="tab_content">
           <h3>Definitions</h3>
           <ul>
           <li>"Factory": means a member of the site VisitmyFactory who creates and publishes an advertisement through the site, in order to host one or more Visitors. Factories refer to any type of company organizing visits or events on their or affiliated premises and are not strictly limited to the general definition of a factory.</li>
<li> "Visitor": means a member of the VisitmyFactory site who asks to make a reservation with a Factory for events that is the subject of an advertisement published by this Factory on the site.</li>
<li>"Member": Any person or company registered on the site who might be subject to an identity check.</li> 
<li> "Service fee": in the context of a booking, VisitmyFactory charges a service fee based on the visit contribution price, as a remuneration for the use of the platform. </li>
<li> "Visit contribution price": means, for a given reservation, the amount of money requested by the Factory and accepted by the Visitor in respect of his/her participation in the costs relating to said reservation.
</li>
           </ul>
           <h3>Acceptance of the general conditions</h3>
  			<p>Members declare that they have read the general conditions of use and accepted them without reservation before booking a visit event with a Factory or advertising a visit event to Visitors.</p>
<p>Members agree that their relations will be governed by these general conditions of use, with the exclusion of any conditions previously available on the website.</p>
<p>If Members do not use the Services in accordance with these Terms and Conditions, this behavior may result, among other things, in the termination or suspension of its rights to use the Services and may be the subject of legal action.
</p>	


<h3> Scope of application</h3>
<p>These general terms and conditions determine the contractual conditions applicable the services offered by the Factories to Visitors.</p>
<p>Visit my Factory ApS provides an Internet platform allowing the publication of offers to prepare for a competition or review and to conclude contracts for the provision of services.</p>
<p>The site is accessible to any physical person residing in Denmark or abroad. Visitors must be over 18 years old to register to the website and proceed with the booking of an event from Factory. </p>
<h3>Purpose</h3>
<p>Visit my Factory ApS offers an online platform to enable Visitors to book visits, events, services or products advertised by Factories.</p>

<h3>Contractual Provisions</h3>
<p>The Visitor is committed to ensuring that his/her information is accurate, complete and up-to-date. He/she undertakes to communicate any modification or regular update of this information.</p>
<p>In order to access certain features of the planned services, the Visitor has created an account with a unique password, exact, up-to-date and complete information when creating the account. The "www.VisitmyFactory.com" website, powered by Visit my Factory ApS, carries out a linking activity between Visitors and Factories.</p>
<p>The contract can only be executed if the Visitor booking the event, service or product is over 18 years old. Factories can allow minors to participate in visits and events, at the condition that they are accompanied by a legal representative over 18 years old. Age restrictions are at the sole discretion of Factories and must consider the safety environment of the visit or event.</p>
<p>The nullity of a contractual clause does not invalidate the general conditions.</p>
<h3>Modification</h3>
<p>Visit my Factory ApS reserves the right to modify the present general conditions subject to informing the Members of the site.</p>
<p>Such modifications shall be applicable to contracts in progress provided that the duly informed Site Members have not expressed their disagreement within a reasonable time.</p>
		 
        </div>
        <div id="tab2" class="tab_content">
        <h3>The internet platform services</h3>
        
       <p> The Visitor's and Factory’s registration on Visit my Factory ApS website are free of charge.</p>
<p>Visit my Factory ApS does not claim any right for the posting of offers of services. The conclusion of the contract requires the Visitor and the Factory to have previously accepted these general conditions of use.</p>
<h3>Verification of the identity of the parties</h3>
<p>Visitor registration is only for physical persons who have a valid identity document and are over 18 years old.</p>
<p>The account opened by the Visitor is strictly personal and the Visitor is not allowed to share it or transfer it to anyone, including relatives or members of his family. The password is strictly personal and confidential. It is forbidden to register several times, in particular under different names. When registering, the Visitor must fill in all the mandatory fields listed in the registration form, in particular his / her name, given name, current address and a valid email address. Visit my Factory ApS is unable to monitor the accuracy of each statement and offers filed on the site, as well as contents published by the Factories and Visitors. Visit my Factory ApS is not responsible in case of usurpation of identity. In these circumstances, any person suspecting the impersonation of his/her identity must immediately inform Visit my Factory ApS.</p>
<p>Factory registration is only for legal entities such as and not restricted to companies, associations and public organisms. Factories are also to fill all the mandatory fields listed in the registration form and be approved by a legal representative of the legal entity with the power to contract. Visit my Factory ApS reserves its rights to contact the Factory by any mean, including physical visit at the premises, to confirm the validity of the registration.</p>
<h3>Obligations of the visitor</h3>
<p>A user account is not transferable, nor hereditary free of charge. The Visitor is responsible for the information it provides. In these circumstances, Visit my Factory ApS can not be held liable for any damage or malfunction resulting from the entry of erroneous or incomplete information. Visit my Factory ApS carries out a very limited control of the data supplied at the time of registration, Identification of persons on the Internet is possible only in a restricted way. Therefore, it is not excluded that an account may contain false information, in spite of the various existing security measures. In the installation of their systems and programs, users must not hinder security, integrity , The availability of the systems used by Visit my Factory ApS for its services. Visit my Factory ApS is authorized to apply emergency measures (including block access) to ensure the integrity of Visit my Factory ApS systems or tiers.</p>


                </div>
        <div id="tab3" class="tab_content">
        <p> Access and registration to the VisitmyFactory platform, as well as the research, consultation and publication of listings are free. However, the reservation is subject to the conditions described below. The full amount of the booking is to be paid by the Visitor prior to the visit event on the VisitmyFactory for the reservation to be valid.</p>

<h3>Viisit contribution price</h3>
<p>The amount of the visit contribution price is determined by the Factory, under its sole responsibility. The full amount has to be paid through the VisitmyFactory platform. If a Factory is subject to the payment of VAT, the amount advertised on the VisitmyFactory platform must be the full price including VAT on visit contribution price.</p>

<h3> Service fees</h3>
<p>As part of an event or visit booking, VisitmyFactory charges a service fee based on the amount of the visit contribution price. In the absence of an alternative agreement between Visit my Factory ApS and the Factory, the following fees are charged for the calculation of the service charges: Following the reservation of services by the Visitor, the amount due will be increased by 20% service charge (20%) with a minimum of 30 DKK (30 Danish Crown) per booking to Visit my Factory ApS.</p> 
<p>VAT on the service fees will also be charged in accordance with the local tax laws of where the Factory is localised.</p>

<p>The Factory does not have the right, in addition to the price indicated, to distribute on the Visitor other fees and taxes which have not been mentioned in the offer and require their payment by the Visitor in relation to the visit or event. Factories are allowed to offer Visitors to buy souvenirs and their own products that have not been advertised as being part of the visit contribution price on their premises, at the sole Factory’s responsibility.</p>
<p>Visitors are prohibited from offering Factories to bypass the service fee or re-sell their booking to other parties.</p>
<h3>Terms of payment and revirsal of the visit contribution price</h3>
<ul><li><b>Terms of collection of the visit contribution price</b>
<p>By using the platform as a Factory, you entrust VisitmyFactory with a mandate to collect the amount of the visit contribution price on your behalf. This is why, within the framework of a booking and after validation of the booking, VisitmyFactory collects the entire amount paid by the Visitor (Service Fee and Visit contribution price). You acknowledge and agree that none of the sums collected in the name and on behalf of the Factory shall be interest-bearing. You agree to respond promptly to any request from VisitmyFactory and more generally of any administrative or judicial authority competent in particular in the prevention or the fight against money laundering. In particular, you agree to provide, upon request, any proof of address and / or identity. In the absence of your response to these requests, VisitmyFactory may take any action that it deems appropriate such as the freezing of sums and / or suspension of your account and / or the termination of the account.</p></li>
<li><b>Payment of the collected visit contribution price</b>
<p>Visit my Factory ApS will transfer around the mid of each month the collected visit contribution price amounts related to the visit events that took place in the previous month. It is to cover for the delay for Visit my Factory ApS to receive the payments from credit card collection company and offer a reasonable time period to Visitors for disputes.</p>
<p>Factories must provide a valid and legal bank account to which the Visit contribution price are to be reversed. The bank account must be owned by the Factory and confirmed by a Factory representative with the sufficient authority. VisitmyFactory will reserve its rights to require additional documents or confirmation to check the authenticity of the information provided by the Factory and its representatives, but has no responsibility in the event of fraud or errors due to the Factory, its affiliates, representatives, employees or any parties involved with the Factory. The Factory must contact VisitmyFactory immediately if it identifies or suspect any fraud or errors related to the payments and accounts.</p>
<p>The credit card information used by Visitors to pay on the VisitmyFactory platform are not handled nor stored on the VisitmyFactory servers. VisitmyFactory uses the services of the payment company “Stripe” to handle the payments and is not liable for any loss of data or any kind of mis-use happening with Stripe, its affiliates and the connection betwen Stripe and the VisitmyFactory platform.</p></li>

<h3>Promotional codes</h3>
<p>VisitmyFactory may, at its sole discretion, create promotional codes that may be used to obtain an account credit. You agree that the promotional codes: - are to be used legally by the public for which they are intended and for the purposes intended - are personal and valid for use, they can not be duplicated, sold or transferred in any way. VisitmyFactory reserves the right to decline or reduce credits or other benefits obtained through the use of promotional codes by you or any other user in case VisitmyFactory would consider or consider that the use of the code was erroneous, fraudulent, illegal or contrary to the conditions applicable to the promotional code or these conditions.</p>

							
        </div>
        <div id="tab4" class="tab_content">
           <h3>Realization of conditions </h3>
<p>The Visitor can, by clicking on the links provided for this purpose, make a reservation for the offer of the Factory on a specific date. When the payment is successful, VisitmyFactory will notify the contracting parties by sending an e-mail confirming the conclusion of the contract. </p>
<p>VisitmyFactory’s mission is to connect the Factories and the Visitors and to facilitate their agreement on the missions entrusted and their execution. However, VisitmyFactory remains a third party to the contractual relationship between the Visitors and the Factories, and Visit my Factory ApS can not be considered a co-contracting party of any of the members. Visit my Factory ApS is not liable for the conclusion and performance of services.</p>
<h3>Modification of the order</h3> 
<p>The orders being final and irrevocable, any request for modification of the service ordered by the Visitor will be rejected.</p> 
<p>The registration information that the Visitor provides when creating an account and any information it provides when accessing and using the services and the IP addresses collected by the company during the connection to the site (hereinafter together the Personal Data), are treated in accordance with the principles of protection of privacy and personal data. VisitmyFactory uses Personal Data for the following purposes: - create and manage the account - allow access and use of services - Responding to requests in the context of the use of services - optimizing the functioning and relevance of services through the realization of statistics.</p>
<p>The data can be anonymised and aggregated in order to optimize the use of the site. VisitmyFactory also uses anonymous data for its surveys and its statistics, in particular as regards the consultation of the site. The Visitor and the Factory have the right to consult and request to modify or delete Personal Data related to their own accounts.</p>
<h3>Content of the Services - Ownership and Responsibility of Visitors and Factories</h3>
<p>Intellectual Property of the Site and all elements that make up the site (such as texts, trees, software, animations, photographs, illustrations, diagrams, logos) are protected by the laws of the Intellectual property and are the exclusive property of Visit my Factory ApS which is the only one authorized to use the intellectual property rights relating thereto. The trademarks and domain names as well as the designs appearing on the site are the exclusive property of the Company. The creation of hypertext links to the Site can only be done with the prior written authorization of the VISIT MY FACTORY APS, which authorization may be revoked at any time. All sites with a hypertext link pointing to the Site are not under Control of the company and therefore declines any responsibility regarding access and content to such sites. Site Members also acknowledge that content included in advertisements, information provided to you through the Services or by third party advertisers is protected by copyright, Trademark law, patent law, or any other right recognized by the laws in force. Use of all or part of the site, in particular by downloading, reproduction, transmission, representation or dissemination for purposes other than Personal and private use for non-commercial purposes is strictly prohibited. Violation of these provisions will subject Site Members to the penalties provided for by the applicable laws, in particular as regards infringement of copyright and trademark law. Ownership and Liability in the Use of the Services.</p>
<p>It is forbidden within the framework of the use of the services to engage in acts of any nature whatsoever (including acts of consultation, downloading, sending, broadcasting, Publication, publication or any other means), which would be contrary to Danish law, would infringe the Danish public order, or the rights of a third party. In particular, and without this list being exhaustive, it is prohibited to: - commit or participate in the commission of acts constituting the apology of crimes against humanity, denial of genocide, incitement to violence, racial hatred or child pornography, - to commit or participate in the commission of acts constituting or inciting to the realization of crimes and offenses including infringement of privacy, the protection of personal data or the secrecy of correspondence, - committing or participating in the commission of acts constituting defamation, insult, threats, harassment, or affecting the image or reputation of other persons, - infringing in any way the minors , to incite them to put themselves in danger in any way, or to allow them access to content likely to offend their sensitivity, - to engage in a violation of intellectual property rights (In particular in the field of music, video, animations, games, software, databases, images, sounds and texts) or any other property rights belonging to others, - falsifying data, messages or documents, message or data headers. Identifying or connecting to services or otherwise manipulating an identifier so as to conceal the origin of the transmission of content via the services; sending or causing to be sent e-mails or instant messages to Persons who have not solicited them or have not respected their legal rights, such as advertisements, promotional material, chain letters or any other form of direct unsolicited search, upload promotional messages on Services.</p>
					
                                           </div>
       <div id="tab5" class="tab_content">
        <p>The present general conditions of use are concluded for an indefinite period, only the duration mentioned in the order form is determined. The contract between the Factory and the Visitor is renewable by express agreement on the platform of VisitmyFactory.</p>	
        </div>
        <div id="tab6" class="tab_content">
        <h3>Time of performance</h3>
<p>The Factory undertakes to carry out the service on the date chosen by the Visitor and at the place mentioned in the order form. </p>
<p><b>Cancellation conditions:</b></p>
<p>Visitors’ bookings are not refundable. Visit my Factory ApS and the Factory are not liable if a Visitor could not attend an event or visit. </p>
<p>If a Factory cancels more than 48h before the event or visit and due to the minimum number of Visitors advertised in the site not being reached, Visitors are fully refunded and only credit transaction costs are charged to Factories and can debited from previous or future amounts payables to the Factory.</p>
<p>In any other case at the exception of force majeure in which a Factory cancels an event or visit,  Visitors will be fully refunded while the full amount of service fee will be charged to the Factory, debitable from previous or future amounts payables to the Factory.</p>
<p>Additionally, VisitmyFactory reserves a right to incur a penalty of 1,000 DKK per event or visit cancelled by a Factory for which Visitors had booked after 2 cancellations not following the allowed cases mentioned here above.</p>
<p>Factories can cancel a visit or event with no charge if no Visitors have booked it. Furthermore, Factories can setup a condition in the advertisement to make their event or visit automatically expire if no Visitors has booked within a specific time before the event or visit happens.</p>
<h3>Hyperlinks </h3>
<p>Services may contain hypertext links directing manually or automatically to other sites or other sources. The company does not have control or responsibility for third party websites or external sources to which these links are redirected. It can not be held responsible for the availability of these sites or sources, nor their content, products or other elements presented or available on these sites or sources.</p>
<h3> Guaranteed Use of Services</h3>
<p>Services are designed to meet the reasonable and normal use of the greatest number, with the Company striving to meet the needs of Site Members. In the event of service interruption, the Company implements all reasonable means of remedying it as soon as possible.</p>
<h3>Compliance</h3>
<p>The Factory undertakes to provide the service requested in accordance with the contractual forecasts for which he is subject to an obligation of means, responsible for the non conformity of the service in the conditions of ordinary law. Visit my Factory ApS undertakes to handle the claim from a Visitor in the shortest possible time in case of a proven failure of the Factory. Visitors must inform VisitmyFactory within 48h in case they want to dispute the service provided by the Factory and claim a refund on the basis that the Factory didn’t deliver its advertised service. Visit my Factory ApS  reserves the right to retaliate against the Factory and to incur contractual liability in the event of a proven breach of the latter. </p>
<h3>Safety obligation accessory to certain services</h3>
<p>Factories are obligated to provide security to the Visitors and are liable for damage to his / her person caused by a lack of security during the period in which he / she is required to deliver services. Factories and Visitors confirm they have taken out a third party liability insurance. Factories must include a safety talk at the beginning of their visit or event and hand out the necessary safety equipment to Visitors when relevant.</p>
<h3>Obligation of confidentiality accessory to certain services</h3>
<p>The Factory shall not disclose information related to the Visitors to third parties without their express written consent.</p>
<p>Visitors must respect confidentiality rules communicated to the Visitors (e.g. potential interdiction of taking pictures). Visitors must follow the visit or event and not try to access unauthorized areas or documents. In case of breach of the confidentiality rules or inappropriate behaviour, Factories are to take legal action directly through the relevant authorities against the Visitor and inform VisitmyFactory.</p>

        </div>
        <div id="tab7" class="tab_content">
        <h3>Disclaimer of liability and force majeure</h3>
<p>The liability of the Factory can not be incurred in the event of non-performance or poor performance of its obligations which is, either due to the Visitor or to the insurmountable and unpredictable fact of a third party to the contract or in the case of force majeure. Apart from these causes of exemption, the liability under common law incurred depends on the qualification of the obligations of the Factory.</p>
<h3>Responsibility of Visit my Factory Aps</h3>
<p>VisitmyFactory is a platform linking Visitors and Factories. Its intervention in the transaction is limited to an information role when concluding the service contract, the terms of which are decided by the parties. Visit my Factory ApS is not responsible for communications, interactions, disputes or relationships between the Visitor and any other Member. Visit my Factory ApS has no control over the veracity or accuracy of the offers and the capacity of the Factory. Visit my Factory ApS ' responsibility can not be sought for the user's failure to fulfill an obligation imposed by the general conditions of use in case of force majeure resulting from an external event (in particular fires, interruptions of the telecommunications network, natural disasters), the fault of a third party or the Factory or the Visitor's own fault. The company can not be held liable for indirect or collateral damages that the Visitor may incur as a result of the use of the services, including without limitation any loss of profit incurred directly or indirectly, loss of business, customers or damage to reputation. The company being free from the organization, modification or cancellation of services, it can not be held liable for damages that the Visitor may incur as a result of changes it may make to the Services or the permanent or temporary cessation of the provision of services. Visit my Factory ApS cannot held be responsible in case of deletion, alteration or inability to record any content or other data retained or transmitted by the user.</p>
	
        </div>
        <div id="tab8" class="tab_content">
        <h3>Termination of the service agreement by Visit my Factory Aps</h3>
<p>Visit my Factory ApS reserves the right to terminate the User Agreement with a notice period of three weeks except in the event of the Visitor's breaches set out below. Visit my Factory ApS may terminate WITHOUT NOTICE general contract of use if: - The behavior of the Visitor is not in conformity with the present general conditions of use, - The information communicated for the inscription on the Internet site "www.VisitmyFactory.com" are deceptive or false, - The website "www.VisitmyFactory.com" is deleted or if it ceases its commercial activity. In the event of closing down of the Factory, future events and visits already booked will be cancelled and refunded to the Visitors at no charge for the Visitors and Factories.</p>
	
        </div>
        <div id="tab9" class="tab_content">
        <h3>Claims</h3>
<p>All claims must be addressed to Visit my Factory ApS at <a href="#" style="color:#ff9000">claims@visitmyfactory.com </a>or Lyongade 17A, 2300 Copenhagen. Any dispute that may arise between the company and a Visitor or a Factory that is not resolved would be submitted to the courts of Copenhagen.</p>

        </div>
    </div>
</div>


</div>
</div>
<div class="clear"></div>



<!--footer start-->
<?php require_once "includes/footer.php"; ?>  
<!--footer end-->
</div>

</body>

</html>

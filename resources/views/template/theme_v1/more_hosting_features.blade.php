{{-- See More Features code --}}
@php
    $segment1 = Request::segment(1);
    $segment2 = Request::segment(2);
    $productname = ($segment2 == 'wordpress-hosting') ? 'Wordpress Hosting' :
                   (($segment1 == 'web-hosting') ? 'Web Hosting' :
                   (($segment2 == 'website-builder') ? 'Website Builder' : ''));
@endphp



   <div class="modal fade more_feature" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content more_feature_modal">
        <h2 class="htwo-prime1 plntbl-hdrttl">Host IT Smart Shared Hosting Features</h2>
    <div class="table-responsive">
        <div class="more-features-close-icon" data-bs-dismiss="modal">x</div>
    <table class="table-responsive">
    <thead>
    </thead> 
    
    <tbody>
        <tr class="more-features-shadow">
            <th class=""></th>
            <th>BASIC</th>
            <th>ESSENTIAL</th>
            <th>PROFESSIONAL</th>
            <th>ENTERPRISE</th>
        </tr>
        <tr>
            <td>Host Website  </td>
            <td>1</td>
            <td>5</td>
            <td>25</td>
            <td>50</td>
        </tr>
        <tr>
            <td>NVMe Disk Space </td>
            <td>10 GB</td>
            <td>25 GB</td>
            <td>50 GB</td>
            <td>100 GB</td>
        </tr>
        <tr>
            <td>Free Domain </td>
            <td> <i class="more-features-no-icon"></i></td>
            <td> <i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Free SSL </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Free Backup </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Control Panel</td>
            <td>cPanel</i></td>
            <td>cPanel</i></td>
            <td>cPanel</td>
            <td>cPanel</td>
        </tr>
        <tr>
            <td>Website Builder </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>1-Click Installer </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>WordPress Optimized </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Bandwidth </td>
            <td>10,000 GB</td>
            <td>25,000 GB</td>
            <td>1,00,000 GB</td>
            <td>2,00,000 GB</td>
        </tr>
        <tr>
            <td>Email Accounts</td>
            <td>5</td>
            <td>25</td>
            <td>60</td>
            <td>100</td>
        </tr>
        <tr>
            <td>MySQL DB's </td>
            <td>10</td>
            <td>50</td>
            <td>250</td>
            <td>500</td>
        </tr>
        <tr>
            <td>NVMe Disk Space </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Subdomains </td>
            <td>5</td>
            <td>Unlimited</td>
            <td>Unlimited</td>
            <td>Unlimited</td>
        </tr>
        <tr>
            <td>FTP users </td>
            <td>5</td>
            <td>Unlimited</td>
            <td>Unlimited</td>
            <td>Unlimited</td>
        </tr>
         <tr>
                                <td>Supports Node.js</td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                            </tr>
                            <tr>
                                <td id="see_more_features">Supports Python</td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                            </tr>

    </tbody>
    
    <tbody>
        <tr class="more-features-plan-features">
            <td colspan="5">Server Features</td>
        </tr>
        <tr>
            <td>Apache with LiteSpeed </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>HTTP/2 </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>PHP 8.0, 8.1, 8.2, 8.3</td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>MySQL (Mariadb 10.x) </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>CGI </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Javascript </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Leverage Browser Caching </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Gzip Compression </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>KeepAlive </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
       
    </tbody>


     <tbody>
        <tr class="more-features-plan-features">
            <td colspan="5">cPanel Features</td>
        </tr>
        <tr>
            <td>FTP Account Management </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Virus Scanner </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>IP Deny Manager </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Index Manager </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Leech Protect </td>
            <td><i class="more-features-no-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Mailman List Manager </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>MIME Types Manager </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Network Tools </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Redirect Manager </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Change Language </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Multiple PHP Support </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Customizable php.ini </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Cron Jobs </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Simple DNS Zone Editor </td>
            <td><i class="more-features-no-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Advanced DNS Zone Editor </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Backup Manager </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Git Version Control </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Resource Usage Monitoring </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>User Manager </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Style and Preferences Management </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Custom Error Pages </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>PHP MyAdmin </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>RAM</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
        </tr>
        <tr>
            <td>Concurrent connections (EP) </td>
            <td>20</td>
            <td>20</td>
            <td>40</td>
            <td>60</td>
        </tr>
        <tr>
            <td>Number of processes (nPROC) </td>
            <td>40</td>
            <td>40</td>
            <td>80</td>
            <td>120</td>
        </tr>
        <tr>
            <td>IO Limit </td>
            <td>1 MBPS</td>
            <td>1 MBPS</td>
            <td>1 MBPS</td>
            <td>1 MBPS</td>
        </tr>
        <tr>
            <td>File (Inode) Limit </td>
            <td>2,00,000</td>
            <td>4,00,000</td>
            <td>6,00,000</td>
            <td>8,00,000</td>
        </tr>
       
    </tbody>
    
    <tbody>
        <tr class="more-features-plan-features">
            <td colspan="5">Security Solutions</td>
        </tr>
        <tr>
            <td>Network Firewall </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Web Application Firewall </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Brute-force Protection </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Exploits and Malware Protect </td>
            <td><i class="more-features-no-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Malware Scan and Reports </td>
            <td><i class="more-features-no-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Two-Factor Authentication (2FA </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        {{-- <tr>
            <td>BitNinja Server Security </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr> --}}
        <tr>
            <td>Account Isolation </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>CageFS Security </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>CloudLinux Servers </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Power / Network / Hardware Redundancy </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
       
    </tbody>
    
    <tbody>
        <tr class="more-features-plan-features">
            <td colspan="5">Install Popular Software with 1-Click</td>
        </tr>
        <tr>
            <td>WordPress </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Joomla </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>phpBB </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>SMF </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Drupal </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Blogs </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Portals </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Content Management System </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Customer Support </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Discussion Boards </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>eCommerce </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Site Builders </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
       
    </tbody>

    <tbody>
        <tr class="more-features-plan-features">
            <td colspan="5">Email Features</td>
        </tr>
        <tr>
            <td>Email Accounts </td>
            <td>5</td>
            <td>10</td>
            <td>60</td>
            <td>Unlimited</td>
        </tr>
        <tr>
            <td>Email Forwarders </td>
            <td>Unlimited</td>
            <td>Unlimited</td>
            <td>Unlimited</td>
            <td>Unlimited</td>
        </tr>
        <tr>
            <td>Email Autoresponders </td>
            <td>Unlimited</td>
            <td>Unlimited</td>
            <td>Unlimited</td>
            <td>Unlimited</td>
        </tr>
        <tr>
            <td>Attachment Limit </td>
            <td>25 MB</td>
            <td>25 MB</td>
            <td>25 MB</td>
            <td>25 MB</td>
        </tr>
        <tr>
            <td>Webmail (Horde & RoundCube) </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>SMTP, POP3, IMAP </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>SpamAssassin </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Mailing Lists </td>
            <td>10</td>
            <td>20</td>
            <td>20</td>
            <td>20</td>
        </tr>
        <tr>
            <td>Catch-all Emails </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Email Aliases </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>SPF and DKIM Support </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Domain Keys </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>BoxTrapper </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Individual Mailbox Storage </td>
            <td>250 MB</td>
            <td>500 MB</td>
            <td>1 GB</td>
            <td>5 GB</td>
        </tr>
        <tr>
            <td>Overall Mailbox Storage </td>
            <td>1 GB</td>
            <td>2 GB</td>
            <td>10 GB</td>
            <td>50 GB</td>
        </tr>
        <tr>
            <td>Email Sends Per Hour </td>
            <td>20</td>
            <td>20</td>
            <td>20</td>
            <td>20</td>
        </tr>
        <tr>
            <td>CSV Import (Email & Forwarders) </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Mobile Compatibility </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Email Calendar </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Webmail in Gmail </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
        <tr>
            <td>Outlook / Thunderbird / Mac Mail </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr>
       
    </tbody>
  

    </table>
    </div>
    </div>
  </div>
</div>
{{-- See More Features code end --}}

<script>
$(document).ready(function(){$('#exampleModal').on('shown.bs.modal',function(){setTimeout(function(){var targetSection=document.getElementById('see_more_features');if(targetSection){targetSection.scrollIntoView({behavior:'smooth',block:'start'})}},300)})})
</script>
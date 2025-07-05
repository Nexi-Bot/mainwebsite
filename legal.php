<?php
require_once 'includes/config.php';
require_once 'includes/header.php';
?>

<div class="min-h-screen py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">
                Legal Information
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Our comprehensive legal documentation covering privacy policies, service agreements, and terms of service.
            </p>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap justify-center mb-8 border-b border-gray-800">
            <button
                onclick="showSection('privacy')"
                id="privacy-tab"
                class="px-6 py-3 font-medium transition-colors duration-200 border-b-2 border-orange-500 text-orange-400"
            >
                Privacy Policy
            </button>
            <button
                onclick="showSection('sla')"
                id="sla-tab"
                class="px-6 py-3 font-medium transition-colors duration-200 border-b-2 border-transparent text-gray-400 hover:text-white hover:border-gray-700"
            >
                Service Level Agreement
            </button>
            <button
                onclick="showSection('terms')"
                id="terms-tab"
                class="px-6 py-3 font-medium transition-colors duration-200 border-b-2 border-transparent text-gray-400 hover:text-white hover:border-gray-700"
            >
                Terms of Service
            </button>
        </div>

        <!-- Content -->
        <div class="bg-gray-900/50 border border-gray-800 rounded-xl p-8">
            <!-- Privacy Policy Section -->
            <div id="privacy-section" class="prose prose-invert max-w-none">
                <h2 class="text-2xl font-bold mb-6 text-orange-400">Privacy Policy</h2>
                <div class="mb-6 text-gray-300">
                    <p><strong>Nexi Bot LTD</strong></p>
                    <p>Company Registration Number: 16502958</p>
                    <p>ICO Registration Number: ZB910034</p>
                    <p><strong>Last Updated:</strong> 05/07/2025</p>
                </div>

                <div class="space-y-6 text-gray-300">
                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">1. INTRODUCTION</h3>
                        <p>This Privacy Policy explains how Nexi Bot LTD ("we," "us," "our," or "the Company"), a company incorporated in England and Wales under company number 16502958, collects, uses, processes, and protects personal data in accordance with the UK General Data Protection Regulation (UK GDPR), the Data Protection Act 2018 & 2025, and other applicable UK data protection laws.</p>
                        <p class="mt-3">We are registered with the Information Commissioner's Office (ICO) under registration number ZB910034.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">2. DATA CONTROLLER</h3>
                        <p>Nexi Bot LTD is the data controller for the purposes of UK data protection law. You can contact us at:</p>
                        <p class="mt-3">Address: 80A Ruskin Avenue, Welling, London, DA16 3QQ<br/>Email: legal@nexibot.uk</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">3. CATEGORIES OF DATA SUBJECTS</h3>
                        <p>We process personal data relating to:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-3">
                            <li>Employees and prospective employees (including individuals under 18 years of age)</li>
                            <li>Parents/guardians of employees under 18 years of age</li>
                            <li>Customers and users of our Discord bot services</li>
                            <li>Website visitors</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">4. EMPLOYEE DATA PROTECTION</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">4.1 Data We Collect</h4>
                        <p>We collect and process the following categories of personal data from our employees:</p>
                        
                        <p class="mt-3 font-medium">For All Employees:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Personal identification information (name, country, date of birth)</li>
                            <li>Contact details (phone number, personal email address)</li>
                            <li>Employment details (job title, department, start date, salary, performance records)</li>
                            <li>Bank account details for payroll purposes (for shareholders only)</li>
                            <li>Emergency contact information (for under 16s)</li>
                            <li>Training records</li>
                        </ul>

                        <p class="mt-3 font-medium">For Employees Under 18:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>All of the above data categories</li>
                            <li>Parental/guardian consent documentation</li>
                            <li>Parental/guardian contact information</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">4.2 Special Provisions for Employees Under 18</h4>
                        <p><strong>Parental Consent:</strong> For employees aged 16 and under, we obtain explicit written consent from parents/guardians before processing any personal data. This consent covers:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Collection and processing of the minor's personal data</li>
                            <li>Storage of personal data on our systems</li>
                            <li>Use of personal data for employment purposes</li>
                            <li>Transfer of data to third-party processors</li>
                        </ul>

                        <p class="mt-3"><strong>Parental Rights:</strong> Parents/guardians of employees under 18 have the right to:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Access their child's personal data held by us</li>
                            <li>Request rectification of inaccurate data</li>
                            <li>Request erasure of data (subject to legal obligations)</li>
                            <li>Withdraw consent at any time</li>
                            <li>Lodge complaints with the ICO</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">4.3 Legal Basis for Processing Employee Data</h4>
                        <p>We process employee personal data under the following legal bases:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Contract Performance: Processing necessary for the voluntary contract</li>
                            <li>Legal Obligation: Compliance with employment law, tax obligations, and health and safety requirements</li>
                            <li>Legitimate Interests: HR administration, security, and business operations</li>
                            <li>Consent: Where specifically obtained, particularly for employees under 18</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">4.4 Employee Data Storage and Systems</h4>
                        <p class="mt-3 font-medium">Current Systems:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Google Docs: Used for document storage and collaboration</li>
                            <li>ODOO: Our primary HR platform for employee records management</li>
                        </ul>

                        <p class="mt-3 font-medium">Future Migration:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Personal data will be migrated to our proprietary website system</li>
                            <li>Data will be stored using MariaDB database technology</li>
                            <li>Enhanced security measures will be implemented during migration</li>
                        </ul>

                        <p class="mt-3 font-medium">Email Systems:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Employee emails are managed through Roundcube Webmail</li>
                            <li>Hosted on webmail.nexibot.uk</li>
                            <li>Third-party software provided by Cybrancee</li>
                            <li>Subject to appropriate data processing agreements</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">4.5 Data Retention - Employees</h4>
                        <p>We retain employee personal data for the following periods:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Current Employees: Throughout employment and as required by law</li>
                            <li>Former Employees: Up to 6 years after termination for tax and legal compliance</li>
                            <li>Unsuccessful Applicants: Up to 6 months after recruitment process</li>
                            <li>Under 18 Employees: Records retained in accordance with child protection requirements</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">5. CUSTOMER DATA PROTECTION</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">5.1 Data We Collect from Customers</h4>
                        <p><strong>Service Data:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Discord server configuration data</li>
                            <li>Discord server IDs</li>
                            <li>Discord server owner IDs</li>
                            <li>User interaction data with our bot</li>
                            <li>Subscription and service usage data</li>
                        </ul>

                        <p class="mt-3"><strong>Billing Data:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Payment information processed through Stripe</li>
                            <li>Subscription status and history</li>
                            <li>Billing addresses (processed by Stripe)</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">5.2 Legal Basis for Processing Customer Data</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Contract Performance: Providing Discord bot services</li>
                            <li>Legitimate Interests: Service improvement and customer support</li>
                            <li>Consent: Where specifically obtained for marketing communications</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">5.3 Customer Data Storage and Processing</h4>
                        <p class="mt-3 font-medium">Service Data:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Stored in MariaDB database</li>
                            <li>Accessible through our website interface</li>
                            <li>Regularly updated to reflect current server configurations</li>
                        </ul>

                        <p class="mt-3 font-medium">Billing Data:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Processed and stored by Stripe (our payment processor)</li>
                            <li>Nexi Bot LTD employees do not have access to full payment card details</li>
                            <li>Employees can access subscription management functions for customer support</li>
                            <li>Employees can cancel subscriptions through our website interface</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">5.4 Data Retention - Customers</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Active Customers: Data retained for duration of service provision</li>
                            <li>Former Customers: Service data retained for up to 12 months</li>
                            <li>Billing Data: Retained by Stripe in accordance with their retention policies and legal requirements</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">6. DATA SHARING AND THIRD-PARTY PROCESSORS</h3>
                        <p>We share personal data with the following categories of third parties:</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">6.1 Service Providers</h4>
                        <p class="mt-3 font-medium">Current:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Google (Google Docs) - Document storage and collaboration</li>
                            <li>ODOO - HR management platform</li>
                            <li>Cybrancee - Email hosting services</li>
                            <li>Stripe - Payment processing</li>
                        </ul>

                        <p class="mt-3 font-medium">Future:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>MariaDB hosting providers</li>
                            <li>Website hosting services</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">6.2 Legal Disclosures</h4>
                        <p>We may disclose personal data where required by:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Court orders or legal proceedings</li>
                            <li>Regulatory investigations</li>
                            <li>Law enforcement requests</li>
                            <li>Compliance with statutory obligations</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">6.3 Data Processing Agreements</h4>
                        <p>All third-party processors are bound by appropriate data processing agreements ensuring:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Adequate security measures</li>
                            <li>Compliance with UK GDPR requirements</li>
                            <li>Restrictions on data use</li>
                            <li>Notification of data breaches</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">7. INTERNATIONAL TRANSFERS</h3>
                        <p>Where personal data is transferred outside the UK, we ensure adequate protection through:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Adequacy decisions</li>
                            <li>Standard Contractual Clauses</li>
                            <li>Binding Corporate Rules</li>
                            <li>Appropriate safeguards as required by UK GDPR</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">8. DATA SUBJECT RIGHTS</h3>
                        <p>Under UK GDPR, data subjects have the following rights:</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">8.1 Right of Access</h4>
                        <p>Request copies of personal data we hold about you</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">8.2 Right to Rectification</h4>
                        <p>Request correction of inaccurate or incomplete data</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">8.3 Right to Erasure</h4>
                        <p>Request deletion of personal data (subject to legal obligations)</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">8.4 Right to Restrict Processing</h4>
                        <p>Request temporary suspension of data processing</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">8.5 Right to Data Portability</h4>
                        <p>Request transfer of data to another controller</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">8.6 Right to Object</h4>
                        <p>Object to processing based on legitimate interests</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">8.7 Rights Related to Automated Decision-Making</h4>
                        <p>Protection against solely automated decision-making</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">8.8 Right to Withdraw Consent</h4>
                        <p>Where processing is based on consent, withdraw consent at any time</p>

                        <p class="mt-3"><strong>Special Provisions for Minors:</strong> For employees under 18, these rights may be exercised by parents/guardians or jointly with the minor, depending on the circumstances and the minor's capacity.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">9. DATA SECURITY</h3>
                        <p>We implement appropriate technical and organisational measures including:</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">9.1 Technical Measures</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Encryption of data in transit and at rest</li>
                            <li>Regular security updates and patches</li>
                            <li>Access controls and authentication systems</li>
                            <li>Secure database configurations</li>
                            <li>Regular security assessments</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">9.2 Organisational Measures</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Staff training on data protection</li>
                            <li>Clear data handling procedures</li>
                            <li>Regular policy reviews and updates</li>
                            <li>Incident response procedures</li>
                            <li>Segregation of duties</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">9.3 Employee Security Obligations</h4>
                        <p>All employees, including those under 18, are required to:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Maintain confidentiality of personal data</li>
                            <li>Follow data protection policies and procedures</li>
                            <li>Report suspected data breaches immediately</li>
                            <li>Attend mandatory data protection training</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">10. DATA BREACH NOTIFICATION</h3>
                        <p>In the event of a personal data breach, we will:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Assess the risk to individuals' rights and freedoms</li>
                            <li>Notify the ICO within 72 hours where required</li>
                            <li>Notify affected individuals without undue delay where high risk exists</li>
                            <li>Document all breaches and remedial actions taken</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">11. PRIVACY BY DESIGN AND DEFAULT</h3>
                        <p>We implement privacy by design principles:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Data protection considerations in system design</li>
                            <li>Privacy impact assessments for new processing activities</li>
                            <li>Regular review of data processing necessity</li>
                            <li>Minimisation of data collection and retention</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">12. CHANGES TO THIS PRIVACY POLICY</h3>
                        <p>We may update this Privacy Policy from time to time. When we make changes:</p>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">12.1 Notification Period</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>All Changes: 7 days advance notice</li>
                            <li>Changes Affecting Minors: Additional notification to parents/guardians</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">12.2 Notification Methods</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Email notification to employees and registered customers</li>
                            <li>Website publication</li>
                            <li>Direct notification to parents/guardians of employees under 18</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">12.3 Consent Requirements</h4>
                        <p>Where changes require new consent, we will obtain explicit agreement before implementing changes.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">13. CONTACT INFORMATION</h3>
                        <p>For questions about this Privacy Policy or to exercise your rights:</p>
                        <p class="mt-3">General Inquiries: Email: legal@nexibot.uk Address: 80A Ruskin Avenue, Welling, London, DA16 3QQ</p>
                        
                        <p class="mt-3">ICO Contact: If you are not satisfied with our response, you can contact the Information Commissioner's Office:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Website: ico.org.uk</li>
                            <li>Phone: 0303 123 1113</li>
                            <li>Address: Information Commissioner's Office, Wycliffe House, Water Lane, Wilmslow, Cheshire, SK9 5AF</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">14. SPECIAL PROVISIONS FOR CHILD PROTECTION</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">14.1 Safeguarding Commitments</h4>
                        <p>We are committed to protecting children in our employment and maintain:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Enhanced DBS checks for relevant positions</li>
                            <li>Child protection policies and procedures</li>
                            <li>Regular safeguarding training for all staff</li>
                            <li>Clear reporting procedures for concerns</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">14.2 Parental Involvement</h4>
                        <p>Parents/guardians of employees under 18 are entitled to:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Regular updates on their child's employment status</li>
                            <li>Access to relevant personal data processed about their child</li>
                            <li>Involvement in any disciplinary or grievance procedures</li>
                            <li>Immediate notification of any safeguarding concerns</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">14.3 Additional Protections</h4>
                        <p>For employees under 18, we provide:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Enhanced privacy protections</li>
                            <li>Restricted access to personal data</li>
                            <li>Additional consent requirements for data sharing</li>
                            <li>Specialized training for managers and supervisors</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">15. COMPLIANCE AND ACCOUNTABILITY</h3>
                        <p>We maintain compliance through:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Regular internal audits</li>
                            <li>Staff training programmes</li>
                            <li>Policy review and updates</li>
                            <li>External legal advice where necessary</li>
                            <li>Ongoing monitoring of data protection regulations</li>
                        </ul>
                        
                        <p class="mt-3">This Privacy Policy demonstrates our commitment to protecting personal data and complying with all applicable UK data protection laws. We regularly review and update our practices to ensure continued compliance and protection of personal data.</p>
                        
                        <p class="mt-3">Document Version: 1.0<br/>Next Review Date: 05/07/2026</p>
                    </section>
                </div>
            </div>

            <!-- SLA Section -->
            <div id="sla-section" class="prose prose-invert max-w-none" style="display: none;">
                <h2 class="text-2xl font-bold mb-6 text-orange-400">Service Level Agreement</h2>
                <div class="mb-6 text-gray-300">
                    <p><strong>Nexi Bot LTD</strong></p>
                    <p>Company Registration Number: 16502958</p>
                    <p>ICO Registration Number: ZB910034</p>
                    <p>Document Version: 1.0</p>
                    <p><strong>Effective Date:</strong> 05/07/2025</p>
                    <p>Review Date: 05/07/2026</p>
                </div>

                <div class="space-y-6 text-gray-300">
                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">1. INTRODUCTION</h3>
                        <p>This Service Level Agreement ("SLA") defines the performance standards and service commitments that Nexi Bot LTD ("Company," "we," "us," or "our") provides to customers ("Customer," "you," or "your") for the Nexi Bot Discord service ("Service").</p>
                        <p class="mt-3">This SLA is incorporated into and forms part of the Terms of Service. In case of conflict between this SLA and the Terms of Service, the Terms of Service shall prevail.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">2. SCOPE OF AGREEMENT</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">2.1 Covered Services</h4>
                        <p>This SLA applies to:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Core Discord bot functionality and commands</li>
                            <li>Premium subscription features</li>
                            <li>Web dashboard and configuration interface</li>
                            <li>API endpoints and integrations</li>
                            <li>Customer support services</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">2.2 Service Tiers</h4>
                        <p><strong>Free Tier Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Basic bot commands and functionality</li>
                            <li>Standard support response times</li>
                            <li>Best-effort availability</li>
                        </ul>

                        <p class="mt-3"><strong>Premium Tier Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Enhanced bot features and capabilities</li>
                            <li>Priority support</li>
                            <li>Enhanced availability commitments</li>
                            <li>Advanced monitoring and reporting</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">2.3 Excluded Services</h4>
                        <p>This SLA does not cover:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Beta or experimental features</li>
                            <li>Third-party integrations beyond our control</li>
                            <li>Custom development or consulting services</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">3. SERVICE AVAILABILITY COMMITMENTS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">3.1 Uptime Definitions</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li><strong>"Uptime"</strong> means the Service is operational and accessible to users as intended.</li>
                            <li><strong>"Downtime"</strong> means the Service is completely inaccessible or non-functional for all users due to issues within our control.</li>
                            <li><strong>"Partial Outage"</strong> means degraded performance affecting some but not all users or features.</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">3.2 Availability Targets</h4>
                        <p><strong>Premium Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Monthly Uptime Target: 99.5%</li>
                            <li>Maximum Allowable Downtime: 3.6 hours per month</li>
                            <li>Response Time Target: Commands execute within 2 seconds under normal load</li>
                        </ul>

                        <p class="mt-3"><strong>Free Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Monthly Uptime Target: 95.0%</li>
                            <li>Maximum Allowable Downtime: 36 hours per month</li>
                            <li>Response Time Target: Commands execute within 5 seconds under normal load</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">3.3 Planned Maintenance</h4>
                        <p><strong>Premium Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Maximum 4 hours planned maintenance per month</li>
                            <li>Minimum 48 hours advance notice</li>
                            <li>Scheduled during low-usage periods (typically 02:00-06:00 GMT)</li>
                        </ul>

                        <p class="mt-3"><strong>Free Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Maximum 8 hours planned maintenance per month</li>
                            <li>Minimum 24 hours advance notice where practical</li>
                            <li>May be scheduled at any time</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">3.4 Measurement Period</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Service availability is measured monthly from 00:00 GMT on the first day to 23:59 GMT on the last day</li>
                            <li>Measurements are based on automated monitoring systems</li>
                            <li>Planned maintenance windows are excluded from availability calculations</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">4. PERFORMANCE STANDARDS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">4.1 Response Time Commitments</h4>
                        <p><strong>Bot Command Response Times:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Simple commands (ping, help): &lt; 1 second</li>
                            <li>Moderate commands (user info, server stats): &lt; 3 seconds</li>
                            <li>Complex commands (database queries, API calls): &lt; 10 seconds</li>
                            <li>Bulk operations: &lt; 30 seconds</li>
                        </ul>

                        <p class="mt-3"><strong>Web Dashboard Performance:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Page load times: &lt; 5 seconds</li>
                            <li>API response times: &lt; 2 seconds</li>
                            <li>Configuration saves: &lt; 10 seconds</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">4.2 Throughput Standards</h4>
                        <p><strong>Command Processing:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Premium: Up to 1000 commands per minute per server</li>
                            <li>Free: Up to 100 commands per minute per server</li>
                        </ul>

                        <p class="mt-3"><strong>Concurrent Users:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>System designed to handle 10,000+ concurrent Discord servers</li>
                            <li>No per-server user limits imposed by our system</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">4.3 Data Consistency</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Configuration changes reflected within 30 seconds</li>
                            <li>Database updates processed within 60 seconds</li>
                            <li>Cross-region synchronization within 5 minutes</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">5. SUPPORT SERVICE LEVELS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">5.1 Support Channels</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Discord support server</li>
                            <li>Email support</li>
                            <li>Web-based ticket system</li>
                            <li>Emergency contact (Premium only)</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">5.2 Response Time Commitments</h4>
                        <p><strong>Premium Support:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Critical Issues: 2 hours (24/7)</li>
                            <li>High Priority: 4 hours (business hours)</li>
                            <li>Medium Priority: 12 hours (business hours)</li>
                            <li>Low Priority: 48 hours (business hours)</li>
                        </ul>

                        <p class="mt-3"><strong>Free Support:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>All Issues: 48 hours (business hours)</li>
                            <li>Community Support: Best effort via Discord</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">5.3 Issue Classification</h4>
                        <p><strong>Critical Issues:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Complete service outage</li>
                            <li>Data loss or corruption</li>
                            <li>Security breaches</li>
                            <li>Payment processing failures</li>
                        </ul>

                        <p class="mt-3"><strong>High Priority:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Significant feature malfunction</li>
                            <li>Performance degradation affecting multiple servers</li>
                            <li>Premium feature unavailable</li>
                        </ul>

                        <p class="mt-3"><strong>Medium Priority:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Minor feature issues</li>
                            <li>Non-critical bugs</li>
                            <li>Configuration problems</li>
                        </ul>

                        <p class="mt-3"><strong>Low Priority:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>General questions</li>
                            <li>Feature requests</li>
                            <li>Documentation clarifications</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">5.4 Business Hours</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Standard Business Hours: Monday-Friday, 09:00-17:00 GMT</li>
                            <li>Premium Support Hours: 24/7 for Critical issues, extended hours for High Priority</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">6. MONITORING AND REPORTING</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">6.1 System Monitoring</h4>
                        <p>We maintain continuous monitoring of:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Service availability and uptime</li>
                            <li>Response times and performance metrics</li>
                            <li>Error rates and failure patterns</li>
                            <li>Resource utilization and capacity</li>
                            <li>Security threats and incidents</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">6.2 Monitoring Tools</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Automated ping and functionality tests every 60 seconds</li>
                            <li>Performance benchmarking every 5 minutes</li>
                            <li>Real-time alerting for service disruptions</li>
                            <li>Third-party monitoring services for verification</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">6.3 Status Communication</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Status Page: Real-time service status at status.nexibot.uk</li>
                            <li>Incident Updates: Posted within 30 minutes of detection</li>
                            <li>Maintenance Notices: Minimum 48 hours advance notice</li>
                            <li>Post-Incident Reports: Published within 72 hours of resolution</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">6.4 Reporting</h4>
                        <p><strong>Monthly SLA Reports:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Actual uptime vs. target uptime</li>
                            <li>Performance metrics summary</li>
                            <li>Incident summary and resolution times</li>
                            <li>Available upon request for Premium customers</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">7. SERVICE CREDITS AND REMEDIES</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">7.1 Service Credit Eligibility</h4>
                        <p>Service credits are available when:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Monthly uptime falls below committed levels</li>
                            <li>The failure is due to causes within our control</li>
                            <li>Customer requests credit within 30 days of the incident</li>
                            <li>Customer's account is in good standing</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">7.2 Service Credit Calculation</h4>
                        <p><strong>Premium Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>99.0% - 99.49% uptime: 10% monthly subscription credit</li>
                            <li>98.0% - 98.99% uptime: 25% monthly subscription credit</li>
                            <li>95.0% - 97.99% uptime: 50% monthly subscription credit</li>
                            <li>Below 95.0% uptime: 100% monthly subscription credit</li>
                        </ul>

                        <p class="mt-3"><strong>Free Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Credits applied as extended premium trial periods</li>
                            <li>90.0% - 94.99% uptime: 7-day premium trial credit</li>
                            <li>Below 90.0% uptime: 14-day premium trial credit</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">7.3 Service Credit Limitations</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Maximum credit per month: 100% of monthly subscription fee</li>
                            <li>Credits cannot be redeemed for cash</li>
                            <li>Credits must be used within 12 months of issuance</li>
                            <li>Credits do not extend subscription terms</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">7.4 Exclusions from Service Credits</h4>
                        <p>No service credits for downtime caused by:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Scheduled maintenance (with proper notice)</li>
                            <li>Customer's actions or configurations</li>
                            <li>Third-party service failures (Discord, hosting providers, etc.)</li>
                            <li>Force majeure events</li>
                            <li>DDoS attacks or security incidents</li>
                            <li>Internet connectivity issues beyond our network</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">8. ESCALATION PROCEDURES</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">8.1 Internal Escalation</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Level 1: Support team response</li>
                            <li>Level 2: Senior technical team engagement</li>
                            <li>Level 3: Management and development team involvement</li>
                            <li>Level 4: Executive team and external vendor coordination</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">8.2 Customer Escalation</h4>
                        <p>If unsatisfied with support response:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Request escalation through existing support channel</li>
                            <li>Contact management directly (Premium customers)</li>
                            <li>Submit formal complaint through website</li>
                            <li>External dispute resolution if necessary</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">8.3 Emergency Procedures</h4>
                        <p>For critical service outages:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Immediate internal alert to on-call team</li>
                            <li>Status page updated within 15 minutes</li>
                            <li>Customer notification within 30 minutes</li>
                            <li>Regular updates every 2 hours until resolution</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">9. CAPACITY MANAGEMENT</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">9.1 Capacity Planning</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Regular assessment of system capacity and performance</li>
                            <li>Proactive scaling before reaching 80% capacity</li>
                            <li>Investment in infrastructure improvements</li>
                            <li>Load testing and performance optimization</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">9.2 Usage Limits</h4>
                        <p><strong>Premium Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Fair usage policy applies</li>
                            <li>Burst capacity available for temporary spikes</li>
                            <li>No hard limits on reasonable usage</li>
                        </ul>

                        <p class="mt-3"><strong>Free Services:</strong></p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Rate limiting to ensure fair access</li>
                            <li>Usage caps may apply during high demand</li>
                            <li>Premium upgrade recommended for heavy usage</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">10. DISASTER RECOVERY</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">10.1 Backup Procedures</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Automated daily backups of all critical data</li>
                            <li>Geographic distribution of backup storage</li>
                            <li>Regular backup restoration testing</li>
                            <li>Retention period: 30 days for operational data, 1 year for critical configurations</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">10.2 Recovery Commitments</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Recovery Time Objective (RTO): 4 hours for critical systems</li>
                            <li>Recovery Point Objective (RPO): Maximum 1 hour of data loss</li>
                            <li>Business Continuity: Essential services maintained during recovery</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">10.3 Disaster Communication</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Immediate status updates during major incidents</li>
                            <li>Regular communication throughout recovery process</li>
                            <li>Post-incident analysis and improvement plans</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">11. SECURITY COMMITMENTS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">11.1 Security Standards</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>ISO 27001 aligned security practices</li>
                            <li>Regular security assessments and penetration testing</li>
                            <li>24/7 security monitoring and threat detection</li>
                            <li>Immediate response to security incidents</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">11.2 Data Protection</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Encryption in transit and at rest</li>
                            <li>Regular security updates and patches</li>
                            <li>Access controls and audit logging</li>
                            <li>GDPR and UK data protection compliance</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">11.3 Incident Response</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Security incident response within 1 hour</li>
                            <li>Customer notification within 24 hours (where legally required)</li>
                            <li>Full incident report within 72 hours</li>
                            <li>Remediation plan and timeline provided</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">12. COMPLIANCE AND AUDIT</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">12.1 Compliance Standards</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>UK GDPR and Data Protection Act 2018</li>
                            <li>PCI DSS (for payment processing)</li>
                            <li>Discord Developer Terms of Service</li>
                            <li>Industry best practices and standards</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">12.2 Audit Rights</h4>
                        <p>Premium customers may request:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Annual SLA compliance reports</li>
                            <li>Security assessment summaries</li>
                            <li>Compliance certification status</li>
                            <li>Third-party audit results (where permitted)</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">13. SLA MODIFICATIONS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">13.1 Review and Updates</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>SLA reviewed every 6 months</li>
                            <li>Updates based on performance data and customer feedback</li>
                            <li>Technology improvements and infrastructure changes</li>
                            <li>Regulatory or compliance requirement changes</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">13.2 Change Process</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>30 days advance notice for material changes</li>
                            <li>Customer consultation for significant modifications</li>
                            <li>Opt-out rights for customers who disagree with changes</li>
                            <li>Documentation of all changes and effective dates</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">14. LIMITATIONS AND DISCLAIMERS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">14.1 Force Majeure</h4>
                        <p>This SLA does not apply during force majeure events including:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Natural disasters and extreme weather</li>
                            <li>Government actions or regulatory changes</li>
                            <li>Internet infrastructure failures beyond our control</li>
                            <li>Cyber attacks or security incidents affecting infrastructure</li>
                            <li>Labor disputes or strikes</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">14.2 Third-Party Dependencies</h4>
                        <p>Performance may be affected by:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Discord API changes or outages</li>
                            <li>Cloud hosting provider issues</li>
                            <li>Internet service provider problems</li>
                            <li>DNS resolution failures</li>
                            <li>Payment processor downtime</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">14.3 Customer Responsibilities</h4>
                        <p>Customers must:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Configure the bot properly according to documentation</li>
                            <li>Maintain appropriate Discord server permissions</li>
                            <li>Report issues promptly through proper channels</li>
                            <li>Provide reasonable cooperation during troubleshooting</li>
                            <li>Keep contact information current</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">15. DEFINITIONS AND METRICS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">15.1 Key Metrics</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li><strong>Availability:</strong> Percentage of time the Service is accessible and functional</li>
                            <li><strong>Response Time:</strong> Time between command initiation and completion</li>
                            <li><strong>Mean Time to Recovery (MTTR):</strong> Average time to restore service after an incident</li>
                            <li><strong>Mean Time Between Failures (MTBF):</strong> Average operational time between service failures</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">15.2 Measurement Tools</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Automated monitoring and alerting systems</li>
                            <li>Third-party uptime monitoring services</li>
                            <li>Performance analytics and logging</li>
                            <li>Customer feedback and incident reports</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">16. CONTACT INFORMATION</h3>
                        <p><strong>SLA Inquiries:</strong> Email: legal@nexibot.uk</p>
                        <p class="mt-3"><strong>Service Credits:</strong> Email: billing@nexibot.uk Web: https://nexibot.uk</p>
                        <p class="mt-3"><strong>Emergency Contact (Premium):</strong> Available 24/7 through premium support portal</p>
                        <p class="mt-3"><strong>Status Updates:</strong> Website: status.nexibot.uk Discord: https://discord.gg/nexibot</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">17. ACKNOWLEDGMENT</h3>
                        <p>This SLA represents our commitment to providing reliable, high-quality Discord bot services. We continuously monitor our performance against these commitments and work to exceed customer expectations.</p>
                        <p class="mt-3">For questions about this SLA or to request service credits, please contact our support team using the information provided above.</p>
                        <p class="mt-3">Document Control:<br/>Version: 1.0<br/>Next Review: 05/07/2026<br/>Distribution: All customers, support team, technical team</p>
                    </section>
                </div>
            </div>

            <!-- Terms of Service Section -->
            <div id="terms-section" class="prose prose-invert max-w-none" style="display: none;">
                <h2 class="text-2xl font-bold mb-6 text-orange-400">Terms of Service</h2>
                <div class="mb-6 text-gray-300">
                    <p><strong>Nexi Bot LTD</strong></p>
                    <p>Company Registration Number: 16502958</p>
                    <p>ICO Registration Number: ZB910034</p>
                    <p><strong>Last Updated:</strong> 05/07/2025</p>
                </div>

                <div class="space-y-6 text-gray-300">
                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">1. INTRODUCTION AND ACCEPTANCE</h3>
                        <p>These Terms of Service ("Terms") constitute a legally binding agreement between you ("User," "you," or "your") and Nexi Bot LTD ("Company," "we," "us," or "our"), a company incorporated in England and Wales under company number 16502958.</p>
                        <p class="mt-3">By accessing, installing, inviting, or using our Discord bot services ("Service," "Bot," or "Nexi Bot"), you acknowledge that you have read, understood, and agree to be bound by these Terms and our Privacy Policy. If you do not agree to these Terms, you must not use our Service.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">2. DEFINITIONS</h3>
                        <ul class="list-disc pl-6 space-y-1">
                            <li><strong>"Service"</strong> means the Nexi Bot Discord application and all related features, functionalities, and services provided by the Company.</li>
                            <li><strong>"Discord"</strong> means Discord Inc. and their communication platform and services.</li>
                            <li><strong>"Server"</strong> means a Discord server/guild where the Bot is installed or invited.</li>
                            <li><strong>"User"</strong> means any individual who interacts with, uses, or accesses the Bot.</li>
                            <li><strong>"Server Owner"</strong> means the individual with administrative control over a Discord server.</li>
                            <li><strong>"Premium Service"</strong> means paid subscription features and services offered by the Company.</li>
                            <li><strong>"Content"</strong> means any data, text, graphics, images, music, software, audio, video, information, or other materials.</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">3. ELIGIBILITY AND AGE REQUIREMENTS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">3.1 Minimum Age</h4>
                        <p>You must be at least 13 years old to use our Service.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">3.2 Discord Terms Compliance</h4>
                        <p>You must comply with Discord's Terms of Service and Community Guidelines. Violation of Discord's terms may result in termination of your access to our Service.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">3.3 Legal Capacity</h4>
                        <p>You represent that you have the legal capacity to enter into these Terms or, if you are a minor, that you have obtained proper parental or guardian consent.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">4. SERVICE DESCRIPTION</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">4.1 Bot Functionality</h4>
                        <p>Nexi Bot provides Discord server management, moderation, entertainment, and utility features including but not limited to:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Server moderation tools</li>
                            <li>User management features</li>
                            <li>Entertainment commands and games</li>
                            <li>Utility functions and integrations</li>
                            <li>Custom server configurations</li>
                            <li>Premium features and enhancements</li>
                        </ul>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">4.2 Service Availability</h4>
                        <p>We strive to maintain Service availability but do not guarantee uninterrupted access. The Service may be temporarily unavailable due to maintenance, updates, or technical issues.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">4.3 Service Modifications</h4>
                        <p>We reserve the right to modify, suspend, or discontinue any aspect of the Service at any time with or without notice.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">5. USER ACCOUNTS AND REGISTRATION</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">5.1 Discord Integration</h4>
                        <p>Our Service integrates with Discord's platform. You must have a valid Discord account to use our Service.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">5.2 Server Authorization</h4>
                        <p>To add the Bot to a Discord server, you must have the "Manage Server" permission or equivalent administrative rights.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-3">5.3 Account Security</h4>
                        <p>You are responsible for maintaining the security of your Discord account and any associated premium accounts with our Service.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">6. ACCEPTABLE USE POLICY</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">6.1 Permitted Uses</h4>
                        <p>You may use the Service for legitimate Discord server management and enhancement purposes in compliance with these Terms and Discord's policies.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">6.2 Prohibited Activities</h4>
                        <p>You must not use the Service to:</p>
                        
                        <p class="mt-3 font-medium">Illegal Activities:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Engage in any illegal activities or violate any applicable laws</li>
                            <li>Facilitate or promote illegal activities</li>
                            <li>Share or distribute illegal content</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">Harmful Content:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Post, share, or distribute hate speech, harassment, or discriminatory content</li>
                            <li>Share violent, graphic, or disturbing content</li>
                            <li>Distribute sexually explicit content involving minors</li>
                            <li>Engage in doxxing or sharing personal information without consent</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">Platform Abuse:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Attempt to circumvent Discord's or our Service's security measures</li>
                            <li>Use automated tools to spam or flood servers</li>
                            <li>Attempt to hack, exploit, or gain unauthorized access to systems</li>
                            <li>Reverse engineer or attempt to extract source code</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">Service Disruption:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Interfere with the normal operation of the Service</li>
                            <li>Overload our systems with excessive requests</li>
                            <li>Attempt to crash or destabilize the Bot or servers</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">Commercial Misuse:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Use the Service for unauthorized commercial purposes</li>
                            <li>Resell or redistribute our Service without permission</li>
                            <li>Use the Service to compete directly with our business</li>
                        </ul>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">6.3 Content Responsibility</h4>
                        <p>You are solely responsible for all content you input, share, or generate through the Service.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">7. PREMIUM SERVICES AND BILLING</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">7.1 Premium Features</h4>
                        <p>Premium Services include enhanced functionality, increased limits, priority support, and exclusive features as described on our website.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">7.2 Subscription Terms</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Premium subscriptions are billed on a recurring basis (monthly or annually)</li>
                            <li>Subscription fees are charged in advance</li>
                            <li>All fees are non-refundable except as required by law</li>
                            <li>Prices may change with 30 days' notice</li>
                        </ul>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">7.3 Payment Processing</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Payments are processed through Stripe</li>
                            <li>You must provide accurate billing information</li>
                            <li>We do not store your payment card details</li>
                            <li>Failed payments may result in service suspension</li>
                        </ul>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">7.4 Cancellation</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>You may cancel your subscription at any time through our website</li>
                            <li>Cancellation takes effect at the end of the current billing period</li>
                            <li>No refunds are provided for partial periods</li>
                        </ul>

                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">7.5 Refund Policy</h4>
                        
                        <p class="mt-3 font-medium">7.5.1 General Refund Conditions</p>
                        <p>Refunds are generally not provided except in the following circumstances:</p>
                        
                        <p class="mt-3 font-medium">Mandatory Refunds:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Where required by applicable consumer protection laws</li>
                            <li>In cases of billing errors or duplicate charges</li>
                            <li>Where we fail to provide the Service due to our breach of contract</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">Service Disruption Refunds:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>If the Service is offline or substantially non-functional for more than 72 consecutive hours due to causes within our control, you may be entitled to a pro-rated refund for the affected period</li>
                            <li>If the Service experiences more than 15% downtime in any calendar month due to causes within our control, you may be entitled to a pro-rated credit or refund for that month</li>
                            <li>Service disruptions caused by Discord platform issues, third-party service failures, DDoS attacks, or other causes beyond our reasonable control do not qualify for refunds</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">Discretionary Refunds:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>At our sole discretion for exceptional circumstances</li>
                            <li>Where we determine the Service has not met reasonable performance standards</li>
                            <li>In cases of documented technical issues that prevent normal Service usage</li>
                        </ul>

                        <p class="mt-6 font-medium">7.5.2 Refund Exclusions</p>
                        <p>Refunds will not be provided for:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Service interruptions lasting less than 72 hours</li>
                            <li>Downtime caused by scheduled maintenance (with reasonable advance notice)</li>
                            <li>Issues arising from Discord platform changes or limitations</li>
                            <li>Third-party service failures (including but not limited to hosting providers, CDNs, or payment processors)</li>
                            <li>Force majeure events including natural disasters, cyber attacks, or infrastructure failures beyond our control</li>
                            <li>User-caused issues including improper bot configuration or server permission problems</li>
                            <li>Violation of these Terms resulting in service termination</li>
                        </ul>

                        <p class="mt-6 font-medium">7.5.3 Service Level Expectations</p>
                        <p>While we do not guarantee 100% uptime, we target:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>99.5% monthly uptime for Premium Services</li>
                            <li>95% monthly uptime for Free Services</li>
                            <li>Maximum 72-hour response time for critical service restoration</li>
                        </ul>

                        <p class="mt-6 font-medium">7.5.4 Refund Process</p>
                        <p>To request a refund:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Contact our support team within 30 days of the incident or billing issue</li>
                            <li>Provide detailed information about the service disruption or billing error</li>
                            <li>Allow us reasonable time (up to 14 business days) to investigate and respond</li>
                            <li>Approved refunds will be processed through the original payment method within 10 business days</li>
                        </ul>

                        <p class="mt-6 font-medium">7.5.5 Partial Refunds and Credits</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Pro-rated refunds are calculated based on the actual days of service disruption</li>
                            <li>We may offer service credits instead of monetary refunds at our discretion</li>
                            <li>Credits do not expire but cannot be transferred or exchanged for cash</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">8. INTELLECTUAL PROPERTY RIGHTS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">8.6 Service Level Agreement (SLA)</h4>
                        
                        <p class="mt-3 font-medium">8.6.1 Uptime Commitment</p>
                        <p>We commit to maintaining reasonable service availability while acknowledging that no online service can guarantee 100% uptime. Our target service levels are:</p>
                        
                        <p class="mt-3 font-medium">Premium Services:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Target: 99.5% monthly uptime</li>
                            <li>Maximum planned maintenance: 4 hours per month (with 48 hours advance notice)</li>
                            <li>Critical issue response time: Within 4 hours</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">Free Services:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Target: 95% monthly uptime</li>
                            <li>Planned maintenance: As needed (with reasonable advance notice)</li>
                            <li>Issue response time: Within 24 hours during business days</li>
                        </ul>

                        <p class="mt-6 font-medium">8.6.2 Service Interruption Classifications</p>
                        
                        <p class="mt-3 font-medium">Planned Maintenance:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Scheduled updates and improvements</li>
                            <li>Infrastructure upgrades</li>
                            <li>Security patches and system maintenance</li>
                            <li>Notice provided at least 48 hours in advance where possible</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">Unplanned Outages:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>System failures within our control</li>
                            <li>Server hardware issues</li>
                            <li>Database connectivity problems</li>
                            <li>Software bugs causing service disruption</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">External Factors (Not Covered by SLA):</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Discord platform outages or API changes</li>
                            <li>Third-party service provider failures</li>
                            <li>Internet infrastructure problems</li>
                            <li>DDoS attacks or security incidents</li>
                            <li>Natural disasters or force majeure events</li>
                        </ul>

                        <p class="mt-6 font-medium">8.6.3 Outage Compensation</p>
                        <p>If we fail to meet our uptime targets due to issues within our control:</p>
                        
                        <p class="mt-3 font-medium">For Premium Users:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>72+ hours consecutive downtime: Full month refund eligibility</li>
                            <li>24-72 hours consecutive downtime: 25% monthly refund or credit</li>
                            <li>Multiple shorter outages exceeding 15% monthly downtime: Pro-rated credit</li>
                        </ul>
                        
                        <p class="mt-3 font-medium">For Free Users:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Extended outages may result in service credits for future premium upgrades</li>
                            <li>No monetary compensation for free service interruptions</li>
                        </ul>
                        
                        <p class="mt-6">The Service, including all code, features, functionality, and design elements, is owned by Nexi Bot LTD and protected by copyright, trademark, and other intellectual property laws.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">8.2 License Grant</h4>
                        <p>We grant you a limited, non-exclusive, non-transferable, revocable license to use the Service in accordance with these Terms.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">8.3 User Content</h4>
                        <p>You retain ownership of content you create or submit through the Service. By using the Service, you grant us a non-exclusive, worldwide, royalty-free license to use, modify, and display such content as necessary to provide the Service.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">8.4 Trademark Usage</h4>
                        <p>You may not use our trademarks, logos, or branding without our express written consent.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">9. DATA PROTECTION AND PRIVACY</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">9.1 Data Collection</h4>
                        <p>We collect and process personal data as described in our Privacy Policy, which is incorporated into these Terms by reference.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">9.2 Data Usage</h4>
                        <p>We use collected data to:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Provide and improve the Service</li>
                            <li>Process payments and manage subscriptions</li>
                            <li>Provide customer support</li>
                            <li>Comply with legal obligations</li>
                        </ul>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">9.3 Data Storage</h4>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Server configuration data and IDs are stored in our MariaDB database</li>
                            <li>Data is accessible through our website interface</li>
                            <li>We implement appropriate security measures to protect your data</li>
                        </ul>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">9.4 Data Retention</h4>
                        <p>We retain data as outlined in our Privacy Policy and as required by law.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">10. DISCLAIMERS AND WARRANTIES</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">10.1 Service Disclaimer</h4>
                        <p>THE SERVICE IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">10.2 No Guarantee of Availability</h4>
                        <p>We do not guarantee that the Service will be available at all times or free from interruptions, errors, or security vulnerabilities.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">10.3 Third-Party Services</h4>
                        <p>The Service integrates with Discord and other third-party platforms. We are not responsible for the availability, functionality, or policies of these third-party services.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">10.4 User Content</h4>
                        <p>We do not endorse, verify, or take responsibility for user-generated content accessed through the Service.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">11. LIMITATION OF LIABILITY</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">11.1 Limitation Scope</h4>
                        <p>TO THE MAXIMUM EXTENT PERMITTED BY LAW, NEXI BOT LTD SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, INCLUDING BUT NOT LIMITED TO LOSS OF PROFITS, DATA, USE, OR GOODWILL.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">11.2 Maximum Liability</h4>
                        <p>Our total liability to you for all claims arising from these Terms or the Service shall not exceed the amount you paid us in the 12 months preceding the claim.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">11.3 Essential Purpose</h4>
                        <p>These limitations apply even if the limited remedies fail of their essential purpose.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">12. INDEMNIFICATION</h3>
                        <p>You agree to indemnify, defend, and hold harmless Nexi Bot LTD, its officers, directors, employees, and agents from any claims, damages, losses, or expenses (including reasonable attorneys' fees) arising from:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Your use of the Service</li>
                            <li>Your violation of these Terms</li>
                            <li>Your violation of any third-party rights</li>
                            <li>Your violation of applicable laws</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">13. TERMINATION</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">13.1 Termination by User</h4>
                        <p>You may terminate your use of the Service at any time by removing the Bot from your servers and canceling any premium subscriptions.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">13.2 Termination by Us</h4>
                        <p>We may terminate or suspend your access to the Service immediately, without notice, for:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Violation of these Terms</li>
                            <li>Violation of Discord's Terms of Service</li>
                            <li>Illegal activities</li>
                            <li>Abuse of the Service</li>
                            <li>Non-payment of fees</li>
                        </ul>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">13.3 Effect of Termination</h4>
                        <p>Upon termination:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Your right to use the Service ceases immediately</li>
                            <li>Premium features will be disabled</li>
                            <li>We may delete your data in accordance with our Privacy Policy</li>
                            <li>Sections of these Terms that should survive termination will remain in effect</li>
                        </ul>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">14. DISPUTE RESOLUTION</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">14.1 Governing Law</h4>
                        <p>These Terms are governed by the laws of England and Wales, without regard to conflict of law principles.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">14.2 Jurisdiction</h4>
                        <p>Any disputes arising from these Terms or your use of the Service shall be subject to the exclusive jurisdiction of the courts of England and Wales.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">14.3 Dispute Process</h4>
                        <p>Before filing any legal action, you agree to first contact us to attempt to resolve the dispute informally.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">15. FORCE MAJEURE</h3>
                        <p>We shall not be liable for any failure or delay in performance under these Terms that is due to fire, flood, earthquake, elements of nature, acts of God, acts of war, terrorism, riots, civil disorders, rebellions, or other similar causes beyond our reasonable control.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">16. COMPLIANCE WITH LAWS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">16.1 Legal Compliance</h4>
                        <p>You must comply with all applicable local, national, and international laws when using the Service.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">16.2 Export Controls</h4>
                        <p>The Service may be subject to export control laws. You agree to comply with all applicable export and import laws.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">16.3 Regulatory Compliance</h4>
                        <p>We comply with applicable UK data protection laws, consumer protection regulations, and other relevant legal requirements.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">17. MODIFICATION OF TERMS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">17.1 Right to Modify</h4>
                        <p>We reserve the right to modify these Terms at any time. Changes will be effective upon posting the updated Terms on our website.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">17.2 Notice of Changes</h4>
                        <p>For material changes, we will provide notice through:</p>
                        <ul class="list-disc pl-6 space-y-1 mt-2">
                            <li>Email notification (where contact information is available)</li>
                            <li>Discord server announcements</li>
                            <li>Website notifications</li>
                            <li>In-service notifications</li>
                        </ul>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">17.3 Continued Use</h4>
                        <p>Your continued use of the Service after changes constitute acceptance of the modified Terms.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">18. SEVERABILITY</h3>
                        <p>If any provision of these Terms is found to be unenforceable or invalid, that provision will be limited or eliminated to the minimum extent necessary so that the remaining Terms remain in full force and effect.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">19. ENTIRE AGREEMENT</h3>
                        <p>These Terms, together with our Privacy Policy, constitute the entire agreement between you and Nexi Bot LTD regarding the Service and supersede all prior agreements and understandings.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">20. ASSIGNMENT</h3>
                        <p>You may not assign or transfer these Terms or your rights hereunder without our prior written consent. We may assign these Terms without restriction.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">21. WAIVER</h3>
                        <p>Our failure to enforce any right or provision of these Terms will not constitute a waiver of such right or provision.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">22. CONTACT INFORMATION</h3>
                        <p>For questions about these Terms or the Service:</p>
                        <p class="mt-3">General Inquiries: Email: legal@nexibot.uk<br/>Website: https://nexibot.uk<br/>Address: 80A Ruskin Avenue, Welling, London, DA16 3QQ</p>
                        <p class="mt-3">Discord Community: https://discord.gg/nexibot</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">23. SPECIAL PROVISIONS</h3>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200">23.1 Discord Developer Terms</h4>
                        <p>Our Service operates under Discord's Developer Terms of Service and API Terms. Users acknowledge that Discord's terms also apply to interactions with our Bot.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">23.2 Service Interruptions</h4>
                        <p>We will make reasonable efforts to provide advance notice of planned maintenance but may need to interrupt service for emergency maintenance without notice.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">23.3 Data Backup</h4>
                        <p>While we implement reasonable backup procedures, users are responsible for maintaining their own backups of critical server configurations and data.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">23.4 Beta Features</h4>
                        <p>Some features may be offered in beta or experimental status. Beta features are provided "as is" with additional disclaimers and may be discontinued without notice.</p>
                        
                        <h4 class="text-lg font-medium mb-2 text-gray-200 mt-6">23.5 Community Guidelines</h4>
                        <p>Users are expected to maintain respectful interactions within any official Nexi Bot communities and support channels.</p>
                    </section>

                    <section>
                        <h3 class="text-xl font-semibold mb-3 text-white">24. ACKNOWLEDGMENT</h3>
                        <p>By using the Service, you acknowledge that you have read these Terms, understand them, and agree to be bound by them. If you do not agree to these Terms, you must not use the Service.</p>
                        
                        <p class="mt-3">Document Version: 1.0<br/>Effective Date: 05/07/2025<br/>Next Review Date: 05/07/2026<br/>Company: Nexi Bot LTD (Registration: 16502958)<br/>ICO Registration: ZB910034</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showSection(sectionName) {
    // Hide all sections
    document.getElementById('privacy-section').style.display = 'none';
    document.getElementById('sla-section').style.display = 'none';
    document.getElementById('terms-section').style.display = 'none';
    
    // Remove active state from all tabs
    document.getElementById('privacy-tab').className = 'px-6 py-3 font-medium transition-colors duration-200 border-b-2 border-transparent text-gray-400 hover:text-white hover:border-gray-700';
    document.getElementById('sla-tab').className = 'px-6 py-3 font-medium transition-colors duration-200 border-b-2 border-transparent text-gray-400 hover:text-white hover:border-gray-700';
    document.getElementById('terms-tab').className = 'px-6 py-3 font-medium transition-colors duration-200 border-b-2 border-transparent text-gray-400 hover:text-white hover:border-gray-700';
    
    // Show selected section and activate tab
    document.getElementById(sectionName + '-section').style.display = 'block';
    document.getElementById(sectionName + '-tab').className = 'px-6 py-3 font-medium transition-colors duration-200 border-b-2 border-orange-500 text-orange-400';
}
</script>

<?php require_once 'includes/footer.php'; ?>

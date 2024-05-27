var ticketTables = document.querySelectorAll(".ticket_table");
var houseeButtons = document.querySelectorAll(".housee");
let arrPowers = ['lolipop', 'chocolate', 'icecream', 'pizza', 'cycle', 'bike', 'bomb', 'car', 'plane'];

function generateTicket() {
    ticketTables.forEach((table) => {

        table.innerHTML = "";

        var usedNumbers = new Set();

        for (var row = 0; row <= 3; row++) {
            var tr = document.createElement("tr");
            for (var col = 0; col < 9; col++) {
                var td = document.createElement("td");
                var innerDiv = document.createElement("div");
                var isDarkCell = (row % 2 == 0 && col % 2 != 0) || (row % 2 != 0 && col % 2 == 0);

                // Generate unique numbers for each cell within the specified range
                var minRange = col * 10 + 1;
                var maxRange = (col + 1) * 10;
                var cellNumber = generateUniqueNumber(usedNumbers, minRange, maxRange);
                usedNumbers.add(cellNumber);

                if (!isDarkCell || (row == 0 && col == 3) || (row == 0 && col == 7) || (row == 0 && col == 5) || (row == 1 && col == 8)) {
                    innerDiv.textContent = cellNumber;
                    innerDiv.classList.add("star")
                }

                if ((row == 0 && col == 8) || (row == 0 && col == 6) || (row == 0 && col == 4)) {
                    innerDiv.textContent = '';
                }

                if (row == 3) {
                    td.style.backgroundColor = "transparent";
                    innerDiv.innerHTML = `<div class="powers">
                                        <figure class="menus">
                                            <img src="http://127.0.0.1:8000/assets/img/powers/${col + 1}.svg" alt="${arrPowers[col]}" width="35px" title="click to use power">
                                        </figure>
                                    </div>`;
                }

                td.className = isDarkCell ? "dark-cell" : "light-cell";
                td.appendChild(innerDiv);
                tr.appendChild(td);
            }
            table.appendChild(tr);
        }
    })

    function generateUniqueNumber(usedNumbers, min, max) {
        var randomNumber;
        do {
            randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;
        } while (usedNumbers.has(randomNumber));

        return randomNumber;
    }
}

function highlightNumber(number) {
    $('#numberTable td').removeClass('highlight-bg');
    $('#numberTable td:contains(' + number + ')').filter(function () {
        return $(this).text() == number;
    }).addClass('highlight highlight-bg');
}

generateTicket();


var cancelNum = document.querySelectorAll(".star");
var powers = document.querySelectorAll(".powers img");
var active = document.querySelectorAll(".powers .menus");
let activeStatus = "inActive";
var selectedPower = null;
var usedPowers = new Set();

active.forEach((element, index) => {
    element.addEventListener("click", () => {
        if (activeStatus === "inActive" || element.classList.contains("activate")) {
            activeStatus = (activeStatus === "inActive") ? "active" : "inActive";

            if (activeStatus === "active") {
                if (!usedPowers.has(arrPowers[index])) {
                    element.classList.toggle("activate");
                    selectedPower = powers[index].alt;
                    usedPowers.add(selectedPower);
                    alert(selectedPower + " activated");
                } else {
                    alert("Power already used.");
                    activeStatus = "inActive"; // reset activeStatus
                }
            } else {
                element.classList.toggle("activate");
                alert(selectedPower + " deactivated");
                selectedPower = null; // Reset selectedPower when deactivating
            }
        } else {
            alert("Another power is already active. Deactivate the current power first.");
        }
    });
});

cancelNum.forEach(element => {
    element.addEventListener("click", () => {
        if (selectedPower) {
            var clickedNumber = parseInt(element.textContent, 10);
            var minRange, maxRange;

            // Define the range based on the selected power
            switch (selectedPower) {
                case 'lolipop':
                    minRange = 1;
                    maxRange = 10;
                    break;
                case 'chocolate':
                    minRange = 11;
                    maxRange = 20;
                    break;
                case 'icecream':
                    minRange = 21;
                    maxRange = 30;
                    break;
                case 'pizza':
                    minRange = 31;
                    maxRange = 40;
                    break;
                case 'cycle':
                    minRange = 41;
                    maxRange = 50;
                    break;
                case 'bike':
                    minRange = 51;
                    maxRange = 60;
                    break;
                case 'bomb':
                    minRange = 61;
                    maxRange = 70;
                    break;
                case 'car':
                    minRange = 71;
                    maxRange = 80;
                    break;
                case 'plane':
                    minRange = 81;
                    maxRange = 90;
                    break;

                default:
                    console.log("Invalid power");
                    return;
            }

            // Check if the clicked number is within the range of the selected power
            if (clickedNumber >= minRange && clickedNumber <= maxRange) {
                // Clear the number (you can modify this part based on your needs)
                element.style.backgroundColor = '#8c0f02';
                console.log("Number " + clickedNumber + " cleared by " + selectedPower);

                // Reset selectedPower after clearing a number
                selectedPower = null;
            } else {
                console.log("Selected power cannot clear the number " + clickedNumber);
            }
        } else {
            console.log("No power activated. Please activate a power first.");
        }
    });
});



function getRandomNumber(usedNumbers) {
    var randomNumber;
    do {
        randomNumber = Math.floor(Math.random() * 90) + 1;
    } while (usedNumbers.includes(randomNumber));
    return randomNumber;
}

function updateWinNumbers(number) {
    $('.numbers').prepend('<div class="win-numbers">' + number + '</div>');
}

var previousNumber;
var usedNumbers = [];

window.addEventListener("load", () => {
    setTimeout(() => {
        setInterval(function () {
            if (usedNumbers.length === 90) {
                console.log("All numbers from 1 to 90 have been used.");
                return;
            }

            var randomNumber = getRandomNumber(usedNumbers);
            highlightNumber(randomNumber);
            updateWinNumbers(randomNumber);

            cancelNum.forEach(element => {
                element.addEventListener("click", () => {
                    var clickedNumber = parseInt(element.textContent, 10);

                    if (clickedNumber === previousNumber) {
                        console.log("Match! You clicked the generated number.");
                        element.style.clipPath = 'polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%)';
                        element.style.backgroundColor = '#8c0f02';
                        matchNumbers.push("win");
                    } else {
                        element.style.clipPath = 'polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%)';
                        element.style.backgroundColor = '#8c0f02';
                        console.log("No match. Try again!");
                    }
                });
            });

            previousNumber = randomNumber;
            usedNumbers.push(randomNumber);

        }, 5000);
    }, 3000);
});

houseeButtons.forEach((element, index) => {
    element.addEventListener("click", () => {
        const illuminatedElement = document.getElementsByClassName("Illuminated")[index];
        const terminateElement = document.getElementsByClassName("terminate")[index];

        if (matchNumbers.length == 15) {
            console.log("housee");
        } else {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I am sure"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Illuminated!",
                        text: "Your ticket has been Illuminated.",
                        icon: "success"
                    });
                    console.log(`Illuminated housee ${index}`);
                    illuminatedElement.style.display = "block";
                    terminateElement.style.cssText = "opacity: 0.5; position: relative; z-index: -1;";
                }
            });
        }
    });
});


window.onload = function () {
    var timer = document.getElementById('timer');
    var mainLoader = document.getElementById('main-loader');
    var loader = document.querySelector(".printing");
    const invite = document.getElementById("invite")
    const leave = document.getElementById("leave")
    const footer = document.querySelector("footer")
    var time = 6;

    timer.style.display = 'inline-block';


    // Countdown timer
    var timerInterval = setInterval(function () {
        timer.innerHTML = time;
        time--;

        if (time <= 0) {
            clearInterval(timerInterval); // Stop the timer when it reaches 0
            loader.style.display = "none";

            footer.style.display = "none";
            // GSAP animations after the timer completes
            gsap.to("#curtain_1", {
                x: '-100%',
                duration: 3
            });

            gsap.to("#curtain_2", {
                x: '100%',
                duration: 3
            }).eventCallback("onComplete", function () {
                mainLoader.style.display = "none";
            });
        }
    }, 1000);


    invite.addEventListener("click", () => {
        footer.style.display = "block"
    })

    leave.addEventListener("click", () => {
        footer.style.display = "none"
    })
}



var selectField = document.getElementById('select-field');
var jobDescriptions = document.getElementById('job-descriptions');

function updateTextarea() {
    var selectedOption = selectField.value;
    var description = '';

    switch (selectedOption) {
        case 'Data science':
            description = 'Utilize statistical methods and machine learning algorithms to extract insights from data, informing strategic decisions and solving complex business problems. Collaborate with cross-functional teams to develop predictive models and data-driven solutions. Conduct thorough data analysis, data cleansing, and data visualization to uncover trends and patterns. Continuously evaluate and refine analytical models to improve accuracy and relevance. Stay updated on emerging trends and technologies in data science and analytics.';
            break;
        case 'Computer network':
            description = 'Plan, design, and implement computer networks, including local area networks (LANs) and wide area networks (WANs), to facilitate seamless data communication and resource sharing. Configure network devices such as routers, switches, and firewalls to optimize performance and ensure network security. Monitor network traffic and troubleshoot connectivity issues to minimize downtime and maintain network uptime. Implement network protocols and standards to ensure interoperability and compatibility across different network environments. Provide technical support and training to end-users on network-related issues and best practices.';
            break;
        case 'Software Engineer':
            description = 'Design, develop, and test software applications and systems, following software engineering principles and best practices. Collaborate with stakeholders to gather requirements and define project objectives, timelines, and deliverables. Write clean, efficient, and maintainable code using programming languages such as Java, Python, or C++. Conduct thorough testing and debugging of software to identify and resolve defects and performance issues. Participate in code reviews and software architecture discussions to ensure high-quality and scalable solutions.';
            break;
        case 'Computer security':
            description = 'Implement and maintain security measures to protect computer systems, networks, and data from unauthorized access, cyber threats, and malicious attacks. Conduct security assessments and risk analyses to identify vulnerabilities and develop mitigation strategies. Configure and manage security tools such as firewalls, intrusion detection systems (IDS), and antivirus software to detect and prevent security breaches. Monitor system logs and network traffic for suspicious activities and respond to security incidents in a timely manner. Stay informed about the latest security threats, trends, and best practices to proactively enhance security posture.';
            break;
        case 'Software':
            description = 'Develop and maintain software applications and systems to meet specific business requirements and objectives. Collaborate with cross-functional teams, including product managers, designers, and developers, to define project scope, requirements, and deliverables. Write clean, modular, and scalable code using programming languages and frameworks such as JavaScript, React, or Node.js. Conduct thorough testing and debugging of software to ensure reliability, performance, and user satisfaction. Continuously optimize and refactor codebase to improve maintainability, efficiency, and scalability.';
            break;
        case 'Network administrator':
            description = 'Manage and maintain computer networks, including troubleshooting network issues, optimizing network performance, and ensuring network security. Install, configure, and upgrade network hardware and software components such as routers, switches, and network operating systems. Monitor network traffic and usage patterns to identify and resolve connectivity issues and performance bottlenecks. Implement network policies and procedures to ensure compliance with security standards and regulatory requirements. Provide technical support and training to end-users on network-related issues and best practices.';
            break;
        case 'Web Developer':
            description = 'Design and develop websites and web applications, utilizing front-end and back-end technologies to create responsive and interactive user interfaces. Collaborate with designers and stakeholders to translate design mockups and wireframes into functional web pages and features. Write clean, efficient, and well-documented code using HTML, CSS, JavaScript, and other programming languages and frameworks. Conduct cross-browser testing and optimization to ensure compatibility and performance across different web browsers and devices. Stay updated on emerging web technologies and best practices to enhance the functionality, usability, and accessibility of web projects.';
            break;
        case 'Computer Systems Analyst':
            description = 'Analyze business requirements and processes, and design information systems solutions to address organizational needs and objectives. Gather and document user requirements, conduct feasibility studies, and perform cost-benefit analyses to evaluate potential solutions. Collaborate with stakeholders, including business users, IT teams, and vendors, to define project scope, timelines, and deliverables. Develop system specifications, including functional requirements, system architecture, and integration points. Provide technical guidance and support throughout the software development lifecycle, from requirements gathering to implementation and maintenance.';
            break;
        case 'Network Engineer':
            description = 'Design, implement, and manage computer networks, including LANs, WANs, and wireless networks, to support business operations and communications. Plan and deploy network infrastructure, including routers, switches, firewalls, and wireless access points, to ensure scalability, reliability, and security. Configure network protocols and services such as TCP/IP, DNS, DHCP, and VPN to facilitate seamless data transmission and connectivity. Monitor network performance and troubleshoot network issues to identify and resolve problems in a timely manner. Collaborate with cross-functional teams to design and implement network solutions that meet business requirements and objectives.';
            break;
        case 'Database Administrator':
            description = 'Design, deploy, and manage databases to store, organize, and retrieve data efficiently and securely. Install, configure, and optimize database management systems (DBMS) such as MySQL, Oracle, or SQL Server to ensure reliability, performance, and data integrity. Define database schemas, tables, and indexes based on business requirements and data modeling principles. Implement database security measures, including user authentication, authorization, and encryption, to protect sensitive information from unauthorized access and data breaches. Monitor database performance, tune queries, and optimize database resources to improve efficiency and scalability.';
            break;
        case 'Systems analyst':
            description = 'Analyze business requirements, design system solutions, and oversee the implementation of new technology systems. Collaborate with stakeholders to gather and document user requirements, and translate them into functional specifications and system designs. Evaluate existing systems and processes to identify opportunities for improvement and automation. Coordinate with development teams to ensure successful implementation and integration of new systems and technologies. Provide training and support to end-users on system functionality and best practices for system utilization.';
            break;
        case 'Technical Support':
            description = 'Provide technical assistance and troubleshooting support to users experiencing hardware or software issues. Diagnose and resolve technical problems related to computer systems, software applications, and peripheral devices. Guide users through step-by-step solutions and provide timely resolution to technical issues via phone, email, or in-person communication. Escalate complex or unresolved issues to higher-level support teams or vendors as necessary. Document support cases, solutions, and troubleshooting steps to maintain accurate records and facilitate knowledge sharing within the support team.';
            break;
        case 'Information technology consulting':
            description = 'Advise organizations on technology strategies, solutions, and best practices to achieve business objectives and overcome challenges. Conduct technology assessments and audits to identify opportunities for improvement and optimization in IT infrastructure, systems, and processes. Develop and present recommendations and roadmaps for implementing new technologies, improving efficiency, and reducing costs. Collaborate with clients to define project scopes, objectives, and deliverables, and oversee the execution of consulting engagements. Provide ongoing support and guidance to clients to ensure successful implementation and adoption of recommended solutions.';
            break;
        case 'Data analysis':
            description = 'Analyze large datasets to extract meaningful insights and inform business decisions using statistical and computational techniques. Cleanse, transform, and preprocess data to ensure accuracy, consistency, and completeness for analysis. Develop and apply statistical models, algorithms, and machine learning techniques to identify trends, patterns, and correlations in data. Visualize and communicate analysis results and findings to stakeholders using charts, graphs, and reports. Collaborate with cross-functional teams to translate data-driven insights into actionable recommendations and strategies for business improvement.';
            break;
        case 'Computer Engineering':
            description = 'Design and develop computer hardware components and systems, including processors, memory devices, and communication interfaces. Conduct feasibility studies and technical assessments to evaluate the performance, cost, and reliability of computer hardware designs. Collaborate with electrical engineers and software developers to integrate hardware and software components and ensure compatibility and functionality. Test and validate hardware designs through simulation, prototyping, and testing processes. Document design specifications, test results, and product requirements to support manufacturing, assembly, and quality assurance processes.';
            break;
        case 'Information Security Analysts':
            description = 'Monitor and protect computer systems and networks from security breaches and cyber threats by implementing security controls and measures. Conduct risk assessments and vulnerability scans to identify and assess security risks and weaknesses. Develop and implement security policies, procedures, and guidelines to ensure compliance with regulatory requirements and industry standards. Investigate security incidents and breaches, and develop incident response plans to mitigate risks and minimize impact. Stay abreast of emerging threats and vulnerabilities, and recommend security solutions and countermeasures to enhance security posture.';
            break;
        case 'Information security':
            description = 'Develop and implement security strategies, policies, and procedures to safeguard sensitive information and protect against unauthorized access, data breaches, and cyber threats. Conduct security assessments and audits to identify vulnerabilities and assess risks to information assets and systems. Implement security controls and technologies such as firewalls, encryption, and intrusion detection systems (IDS) to prevent and detect security incidents. Monitor and analyze security logs and alerts to identify suspicious activities and security breaches. Provide security awareness training and guidance to employees to promote a culture of security and compliance.';
            break;
        case 'Analyst':
            description = 'Analyze data, processes, and systems to provide insights and recommendations for improving performance, efficiency, and decision-making. Gather and evaluate information from various sources, including databases, reports, and stakeholders, to identify trends, patterns, and anomalies. Develop and maintain analytical models, algorithms, and dashboards to visualize and communicate analysis results to stakeholders. Collaborate with cross-functional teams to define key performance indicators (KPIs) and metrics, and measure progress towards business goals and objectives. Continuously monitor and evaluate business processes and performance to identify opportunities for optimization and improvement.';
            break;
        case 'Business':
            description = 'Identify opportunities for business improvement, develop strategies, and implement solutions to drive growth, profitability, and operational excellence. Analyze market trends, customer needs, and competitive landscape to identify opportunities for product and service innovation. Develop business plans, budgets, and forecasts to support strategic decision-making and resource allocation. Collaborate with internal teams and external partners to develop and execute marketing, sales, and operational initiatives. Monitor and evaluate business performance against key performance indicators (KPIs) and benchmarks, and implement corrective actions as needed to achieve business objectives.';
            break;
        case 'IT Technician':
            description = 'Install, configure, and maintain computer hardware, software, and peripherals to ensure optimal performance and functionality. Provide technical support and troubleshooting assistance to users experiencing hardware or software issues. Diagnose and resolve technical problems related to computer systems, networks, printers, and other IT equipment. Install and update software applications, operating systems, and security patches to protect against vulnerabilities and security threats. Document support tickets, solutions, and troubleshooting steps to maintain accurate records and facilitate knowledge sharing within the IT department.';
            break;
        case 'Computer Network Architects':
            description = 'Design and build computer networks, including LANs, WANs, and intranets, to meet business requirements and support organizational objectives. Develop network architecture and infrastructure plans, including network topology, protocols, and security measures. Collaborate with stakeholders to define network requirements, specifications, and performance metrics. Evaluate and recommend network technologies, products, and solutions to optimize performance, scalability, and reliability. Provide technical guidance and support to network engineers and administrators during network implementation and troubleshooting activities.';
            break;
        case 'Computer scientist':
            description = 'Conduct research, design algorithms, and develop software solutions to solve complex computational problems and advance scientific knowledge. Analyze and evaluate algorithms, data structures, and optimization techniques to improve computational efficiency and performance. Develop and implement software systems and applications using programming languages such as C++, Java, or Python. Collaborate with interdisciplinary teams to address multidisciplinary challenges and opportunities in fields such as artificial intelligence, machine learning, and computer vision. Publish research findings and contribute to academic and scientific communities through conferences, journals, and collaborations.';
            break;
        case 'Computer Support Specialists':
            description = 'Provide technical assistance and support to computer users experiencing hardware or software issues, troubleshooting problems and providing solutions to restore functionality. Diagnose and resolve technical problems related to computer systems, software applications, and peripherals. Install, configure, and maintain computer hardware, software, and operating systems to ensure optimal performance and security. Train end-users on hardware and software usage, best practices, and security protocols to enhance productivity and minimize technical issues. Document support cases, solutions, and troubleshooting steps to maintain accurate records and facilitate knowledge sharing within the support team.';
            break;
        case 'Architect':
            description = 'Design and plan the structure and functionality of software systems, ensuring scalability, reliability, and performance to meet business requirements and objectives. Collaborate with stakeholders to gather requirements, define project scope, and establish architectural principles and design patterns. Develop architectural blueprints, diagrams, and documentation to communicate design concepts and technical specifications to development teams and stakeholders. Evaluate and recommend technologies, frameworks, and platforms to support system architecture and development. Provide technical leadership and guidance to development teams during the implementation and evolution of software systems.';
            break;

    }

    jobDescriptions.value = description;
}

selectField.addEventListener('change', updateTextarea);

updateTextarea();
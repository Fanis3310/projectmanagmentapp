<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Members</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#4c64ff',
                        'light-bg': '#f5f7fa',
                        'card-bg': '#ffffff',
                        'sidebar-bg': '#ffffff',
                        'text-primary': '#1f2937',
                        'text-secondary': '#6b7280'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --primary-color: #4c64ff;
            --primary-hover: #3d52cc;
            --bg-color: #f4f5f7;
            --sidebar-bg: #1e1e2d;
            --sidebar-text: #a2a3b7;
            --text-dark: #2d3436;
            --text-light: #636e72;
            --white: #ffffff;
            --border: #dfe6e9;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            --modal-overlay: rgba(0, 0, 0, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            background-color: var(--white);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            padding: 20px;
            flex-shrink: 0;
            border-right: 1px solid var(--border);
        }



        .menu-item {
            padding: 12px 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 5px;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }


        /* --- MAIN CONTENT --- */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .content-area {
            padding: 30px;
            overflow-y: auto;
            height: 100%;
        }

        /* --- TEAM GRID --- */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .team-card {
            background: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid transparent;
            transition: all 0.2s ease;
            position: relative;
        }

        .team-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-color);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .member-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .member-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .member-role {
            font-size: 14px;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .member-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-light);
        }

        .info-item i {
            color: var(--primary-color);
            width: 16px;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: #e8f5e9;
            color: #10b981;
        }

        .status-inactive {
            background: #ffebee;
            color: #ef4444;
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: 0.2s;
        }

        .dropdown-toggle:hover {
            background: #f0f0f0;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 150px;
            z-index: 100;
            margin-top: 5px;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-item {
            padding: 10px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
            color: var(--text-dark);
            font-size: 14px;
        }

        .dropdown-item:hover {
            background: #f5f7fa;
        }

        .dropdown-item.delete {
            color: #ef4444;
        }

        .dropdown-item.delete:hover {
            background: #fee;
        }

        /* --- MODAL --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--modal-overlay);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .modal-content {
            background: var(--white);
            width: 500px;
            max-height: 90vh;
            border-radius: 12px;
            padding: 30px;
            position: relative;
            transform: translateY(20px);
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
            cursor: pointer;
            color: var(--text-light);
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: var(--primary-color);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            color: var(--text-dark);
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
        }

        .no-results i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }
    </style>
</head>
<body class="bg-light-bg font-sans min-h-screen flex">

    <!-- Sidebar -->
    
    <div id="sidebar" class="sidebar fixed inset-y-0 left-0 w-64 bg-sidebar-bg p-4 flex flex-col border-r border-gray-100 lg:relative lg:translate-x-0 overflow-y-auto">
        <div class="mb-8 font-bold text-xl text-primary-blue">Project</div>
        
        <nav class="flex-grow">
            <div class="text-xs font-semibold uppercase text-text-secondary mb-2">Menu</div>
            
            <a href="index.php" id="nav-home" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Home
            </a>

            <a href="project.php" id="nav-projects" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Projects
            </a>

            <a href="calendar.php" id="nav-calendar" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Calendar
            </a>

            <a href="#" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                My Tasks
            </a>

            <a href="#" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                Notifications
            </a>

            <a href="#" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2 4v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7"></path>
                </svg>
                Contacts
            </a>

            <a href="team.php" id="nav-team" class="nav-link flex items-center p-3 rounded-xl bg-indigo-50 text-primary-blue font-medium mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Team
            </a>
        </nav>
    </div>


    <!-- Main Content -->
    <div id="main-content" class="flex-1 flex flex-col lg:ml-0 transition-all duration-300">
        <!-- Header -->
 
        <header class="bg-card-bg p-4 sticky top-0 z-40 shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <button id="menu-button" class="lg:hidden p-2 rounded-md text-text-primary mr-3 hover:bg-light-bg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 id="page-title" class="text-2xl font-semibold text-text-primary">Team Members</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button class="p-2 rounded-full text-text-secondary hover:bg-light-bg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                    
                    <button id="new-member-button" class="flex items-center bg-primary-blue text-white py-2 px-4 rounded-xl font-medium shadow-md hover:bg-indigo-700 transition duration-150" onclick="openModal()">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Member
                    </button>
                </div>
            </div>
        </header>


        <!-- Team Grid -->
        <div class="content-area">
            <div class="team-grid" id="teamGrid">
                <!-- Team members will be inserted here -->
            </div>
            <div id="noResults" class="no-results hidden">
                <i class="fa-solid fa-users"></i>
                <p>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal-overlay" id="memberModal">
        <div class="modal-content">
            <i class="fa-solid fa-xmark close-modal" onclick="closeModal()"></i>
            <div class="modal-title" id="modalTitle">Add Team Member</div>
            
            <form id="memberForm">
                <div class="form-group">
                    <label class="form-label">Name *</label>
                    <input type="text" class="form-input" id="inputName" placeholder="Enter full name" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" class="form-input" id="inputEmail" placeholder="email@example.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-input" id="inputRole" placeholder="e.g. Developer, Designer">
                </div>

                <div class="form-group">
                    <label class="form-label">Department</label>
                    <input type="text" class="form-input" id="inputDepartment" placeholder="e.g. Engineering, Marketing">
                </div>

                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-input" id="inputPhone" placeholder="+30 123 456 7890">
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="inputStatus">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-outline" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-primary" onclick="saveMember()">Save Member</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Team members array
        let members = [];
        let currentId = null;
        let currentDropdown = null;

        const grid = document.getElementById('teamGrid');
        const modal = document.getElementById('memberModal');
        const modalTitle = document.getElementById('modalTitle');
        const nameInput = document.getElementById('inputName');
        const emailInput = document.getElementById('inputEmail');
        const roleInput = document.getElementById('inputRole');
        const departmentInput = document.getElementById('inputDepartment');
        const phoneInput = document.getElementById('inputPhone');
        const statusInput = document.getElementById('inputStatus');
        const noResults = document.getElementById('noResults');

        // Load members from database
        async function loadMembers() {
            try {
                const response = await fetch('team_handler.php?action=getMembers');
                const data = await response.json();
                members = data;
                renderMembers();
            } catch (error) {
                console.error('Error loading members:', error);
                alert('Failed to load team members!');
            }
        }

        // Render members to grid
        function renderMembers() {
            grid.innerHTML = '';

            if (members.length === 0) {
                grid.style.display = 'none';
                noResults.classList.remove('hidden');
                return;
            }

            grid.style.display = 'grid';
            noResults.classList.add('hidden');

            members.forEach(member => {
                const initials = member.name.split(' ').map(n => n[0]).join('').toUpperCase();
                const statusClass = `status-${member.status}`;
                const statusText = member.status.charAt(0).toUpperCase() + member.status.slice(1);

                const card = document.createElement('div');
                card.className = 'team-card';

                card.innerHTML = `
                    <div class="card-header">
                        <div class="status-badge ${statusClass}">${statusText}</div>
                        <div class="dropdown">
                            <div class="dropdown-toggle" onclick="toggleDropdown(event, ${member.id})">
                                <i class="fa-solid fa-ellipsis" style="color: #b2bec3;"></i>
                            </div>
                            <div class="dropdown-menu">
                                <div class="dropdown-item" onclick='openModal(${JSON.stringify(member).replace(/'/g, "&#39;")})'>
                                    <i class="fa-solid fa-pen"></i> Edit
                                </div>
                                <div class="dropdown-item delete" onclick="deleteMember(event, ${member.id})">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="member-avatar">${initials}</div>
                    <div class="member-name">${member.name}</div>
                    <div class="member-role">${member.role || 'No role assigned'}</div>
                    <div class="member-info">
                        <div class="info-item">
                            <i class="fa-solid fa-envelope"></i>
                            <span>${member.email}</span>
                        </div>
                        ${member.department ? `
                        <div class="info-item">
                            <i class="fa-solid fa-building"></i>
                            <span>${member.department}</span>
                        </div>
                        ` : ''}
                        ${member.phone ? `
                        <div class="info-item">
                            <i class="fa-solid fa-phone"></i>
                            <span>${member.phone}</span>
                        </div>
                        ` : ''}
                    </div>
                `;

                grid.appendChild(card);
            });
        }

        // Toggle dropdown
        function toggleDropdown(event, memberId) {
            event.stopPropagation();
            const dropdown = event.currentTarget.nextElementSibling;

            if (currentDropdown && currentDropdown !== dropdown) {
                currentDropdown.classList.remove('active');
            }

            dropdown.classList.toggle('active');
            currentDropdown = dropdown.classList.contains('active') ? dropdown : null;
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (currentDropdown && !e.target.closest('.dropdown')) {
                currentDropdown.classList.remove('active');
                currentDropdown = null;
            }
        });

        // Open modal
        function openModal(member = null) {
            modal.classList.add('active');

            if (member) {
                // EDIT MODE
                currentId = member.id;
                modalTitle.innerText = 'Edit Team Member';
                nameInput.value = member.name;
                emailInput.value = member.email;
                roleInput.value = member.role || '';
                departmentInput.value = member.department || '';
                phoneInput.value = member.phone || '';
                statusInput.value = member.status;
            } else {
                // NEW MODE
                currentId = null;
                modalTitle.innerText = 'Add Team Member';
                nameInput.value = '';
                emailInput.value = '';
                roleInput.value = '';
                departmentInput.value = '';
                phoneInput.value = '';
                statusInput.value = 'active';
            }
        }

        // Close modal
        function closeModal() {
            modal.classList.remove('active');
        }

        // Close modal when clicking overlay
        modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });

        // Save member
        async function saveMember() {
            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const role = roleInput.value.trim();
            const department = departmentInput.value.trim();
            const phone = phoneInput.value.trim();
            const status = statusInput.value;

            if (!name || !email) {
                return alert("Name and Email are required!");
            }

            const memberData = {
                id: currentId,
                name: name,
                email: email,
                role: role,
                department: department,
                phone: phone,
                status: status
            };

            try {
                const response = await fetch('team_handler.php?action=saveMember', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(memberData)
                });
                const result = await response.json();

                if (result.success) {
                    await loadMembers();
                    closeModal();
                } else {
                    alert('Failed to save member: ' + (result.error || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error saving member:', error);
                alert('Failed to save member!');
            }
        }

        // Delete member
        async function deleteMember(event, memberId) {
            event.stopPropagation();

            if (confirm('Are you sure you want to delete this team member?')) {
                try {
                    const response = await fetch('team_handler.php?action=deleteMember', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({id: memberId})
                    });
                    const result = await response.json();

                    if (result.success) {
                        await loadMembers();
                    } else {
                        alert('Failed to delete member!');
                    }
                } catch (error) {
                    console.error('Error deleting member:', error);
                    alert('Failed to delete member!');
                }

                if (currentDropdown) {
                    currentDropdown.classList.remove('active');
                    currentDropdown = null;
                }
            }
        }

        // Load on page load
        window.addEventListener('DOMContentLoaded', loadMembers);
    </script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-color: #4c64ff;
            --primary-hover: #3d52cc;
            --bg-color: #f4f5f7;
            --sidebar-bg: #1e1e2d; /* Or white based on your preference */
            --white: #ffffff;
            --border: #dfe6e9;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            --text-dark: #2d3436;
            --text-light: #636e72;
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


                /* --- NOTIFICATIONS SCROLL FIX --- */
        #notifList {
            /* Υπολογίζουμε περίπου 70px ανά ειδοποίηση x 5 = 350px */
            max-height: 350px; 
            overflow-y: auto; /* Εμφανίζει scrollbar αν ξεπεράσει το ύψος */
        }

        /* Στυλ για την μπάρα κύλισης (για να ταιριάζει με τα υπόλοιπα) */
        #notifList::-webkit-scrollbar {
            width: 5px;
        }
        #notifList::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 0 0 12px 0; /* Στρογγυλοποίηση κάτω δεξιά */
        }
        #notifList::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 20px;
        }
        #notifList::-webkit-scrollbar-thumb:hover {
            background-color: #8d8f91ff;
        }

        /* --- DASHBOARD SPECIFIC STYLES --- */
        .content-area {
            padding: 30px;
            overflow-y: auto;
            height: 100%;
        }

        /* KPI Cards */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            border-color: var(--primary-color);
        }

        .kpi-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .kpi-icon.blue { background: #e0e7ff; color: #4c64ff; }
        .kpi-icon.green { background: #d1fae5; color: #10b981; }
        .kpi-icon.orange { background: #ffedd5; color: #f59e0b; }

        .kpi-info h3 { font-size: 14px; color: var(--text-light); margin-bottom: 5px; }
        .kpi-info h2 { font-size: 28px; font-weight: 700; color: var(--text-dark); margin: 0; }

        /* Dashboard Main Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid { grid-template-columns: 1fr; }
        }

        .section-card {
            background: var(--white);
            border-radius: 16px;
            padding: 25px;
            box-shadow: var(--shadow);
            height: 100%;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title { font-size: 18px; font-weight: 700; color: var(--text-dark); }
        .view-all { font-size: 13px; color: var(--primary-color); font-weight: 600; text-decoration: none; }
        .view-all:hover { text-decoration: underline; }

        /* Project Table */
        .dashboard-table { width: 100%; border-collapse: collapse; }
        .dashboard-table th { text-align: left; padding: 12px; color: var(--text-light); font-size: 12px; font-weight: 600; border-bottom: 1px solid var(--border); }
        .dashboard-table td { padding: 15px 12px; border-bottom: 1px solid #f3f4f6; color: var(--text-dark); font-size: 14px; }
        .dashboard-table tr:last-child td { border-bottom: none; }
        
        .status-dot { height: 8px; width: 8px; border-radius: 50%; display: inline-block; margin-right: 6px; }
        .status-active { background-color: #10b981; }
        .status-planning { background-color: #f59e0b; }
        .status-completed { background-color: #3b82f6; }

        /* Event List */
        .event-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .event-item:last-child { border-bottom: none; padding-bottom: 0; }
        
        .event-date-box {
            background: #f8fafc;
            border-radius: 10px;
            padding: 8px 12px;
            text-align: center;
            min-width: 60px;
        }
        .event-day { font-size: 18px; font-weight: 700; color: var(--primary-color); display: block; }
        .event-month { font-size: 11px; text-transform: uppercase; color: var(--text-light); font-weight: 600; }

        .event-details h4 { font-size: 15px; font-weight: 600; color: var(--text-dark); margin-bottom: 4px; }
        .event-details p { font-size: 13px; color: var(--text-light); }
        .event-badge { font-size: 10px; padding: 2px 8px; border-radius: 10px; background: #e0e7ff; color: #4c64ff; font-weight: 600; margin-left: 5px; }

        /* Team Avatars */
        .team-preview {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .mini-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: #64748b;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .mini-avatar:hover { transform: translateY(-3px); z-index: 10; }

        /* --- NOTIFICATIONS --- */
    .notification-badge {
        position: absolute;
        top: -5px;     
        right: -5px;    
        min-width: 18px; 
        height: 18px;
        background-color: #ef4444; 
        color: white;
        border-radius: 50%;
        border: 2px solid white;
        display: none; 
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
        padding: 0 4px; /
        animation: pulse 2s infinite;
    }
    
    .notification-dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        width: 300px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.6);
        border: 1px solid #f3f4f6;
        z-index: 100;
        margin-top: 10px;
        overflow: hidden;
    }

    .notification-dropdown.active {
        display: block;
        animation: slideDown 0.3s ease;
    }

    .notif-header {
        padding: 15px;
        border-bottom: 1px solid #f3f4f6;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notif-item {
        padding: 15px;
        border-bottom: 1px solid #f3f4f6;
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        gap: 12px;
        align-items: start;
        text-decoration: none; /* Για το <a> tag */
    }

    .notif-item.unread {
        background-color: #fff;
    }
    .notif-item.unread .notif-content h4 {
        color: #1f2937;
        font-weight: 800; /* Πολύ έντονο */
    }
    .notif-item.unread .notif-content p {
        color: #4b5563;
        font-weight: 600;
    }
    .notif-item.unread::before {
        content: '';
        position: absolute;
        left: 0;
        width: 4px;
        height: 100%; /* Θα χρειαστεί relative στο parent */
        background-color: #4c64ff;
        border-radius: 0 4px 4px 0;
    }

    /* Διαβασμένο: Γκρι φόντο, αχνά γράμματα */
    .notif-item.read {
        background-color: #f9fafb;
    }
    .notif-item.read .notif-icon {
        background-color: #e5e7eb; /* Γκρι εικονίδιο */
        color: #9ca3af;
    }
    .notif-item.read .notif-content h4 {
        color: #6b7280;
        font-weight: 500;
    }
    .notif-item.read .notif-content p {
        color: #9ca3af;
    }

    .notif-item { position: relative; }
    
    .notif-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #e0e7ff;
        color: #4c64ff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notif-content h4 { font-size: 14px; margin: 0 0 4px 0; color: var(--text-dark); font-weight: 600; }
    .notif-content p { font-size: 12px; margin: 0; color: var(--text-light); }
    .notif-time { font-size: 10px; color: #94a3b8; margin-top: 4px; display: block; }

    /* Toast Notification */
    .toast-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .toast {
        background: white;
        padding: 16px 20px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        border-left: 5px solid #4c64ff;
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 300px;
        transform: translateX(120%);
        transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }

    .toast.show { transform: translateX(0); }
    
    .toast i { font-size: 20px; color: #4c64ff; }
    .toast-msg { font-weight: 600; color: #1f2937; font-size: 14px; }

    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }
    </style>
</head>
<body class="bg-light-bg font-sans min-h-screen flex">

    <div id="sidebar" class="sidebar fixed inset-y-0 left-0 w-64 bg-white p-4 flex flex-col border-r border-gray-100 lg:relative lg:translate-x-0 transform -translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
        <div class="mb-8 font-bold text-xl text-primary-blue">Project</div>
        
        <nav class="flex-grow">
            <div class="text-xs font-semibold uppercase text-text-secondary mb-2">Menu</div>
            
            <a href="index.php" id="nav-home" class="nav-link flex items-center p-3 rounded-xl bg-indigo-50 text-primary-blue font-medium mb-1">
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

            <a href="team.php" id="nav-team" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Team
            </a>
        </nav>
    </div>

    <div id="main-content" class="flex-1 flex flex-col lg:ml-0 transition-all duration-300">
        
        <header class="bg-card-bg p-4 sticky top-0 z-40 shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <button id="menu-button" class="lg:hidden p-2 rounded-md text-text-primary mr-3 hover:bg-light-bg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div>
                        <h1 class="text-2xl font-semibold text-text-primary">Dashboard</h1>
                        <p class="text-sm text-text-secondary hidden md:block">Welcome back, User!</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    
                    <div class="relative">
                        <button id="notifBtn" class="p-2 rounded-full text-text-secondary hover:bg-light-bg relative" onclick="toggleNotifications()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <div id="notifBadge" class="notification-badge">0</div> 
                        </button>
                        
                        <div id="notifDropdown" class="notification-dropdown">
                            <div class="notif-header">
                                <span>Notifications</span>
                                <span class="text-xs text-primary-blue cursor-pointer" onclick="clearNotifications()">Mark all read</span>
                            </div>
                            <div id="notifList">
                                <div class="p-4 text-center text-gray-400 text-sm">No new notifications</div>
                            </div>
                        </div>
                    </div>

                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-primary-blue font-bold">U</div>
                </div>
            </div>
        </header>

        <div class="content-area">
            
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-info">
                        <h3>Total Projects</h3>
                        <h2 id="totalProjects">0</h2>
                    </div>
                    <div class="kpi-icon blue">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-info">
                        <h3>Upcoming Events</h3>
                        <h2 id="totalEvents">0</h2>
                    </div>
                    <div class="kpi-icon orange">
                        <i class="fa-regular fa-calendar-check"></i>
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-info">
                        <h3>Team Members</h3>
                        <h2 id="totalTeam">0</h2>
                    </div>
                    <div class="kpi-icon green">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="section-card">
                    <div class="section-header">
                        <div class="section-title">Recent Projects</div>
                        <a href="project.php" class="view-all">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="dashboard-table" id="projectTable">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Team</th>
                                </tr>
                            </thead>
                            <tbody id="projectTableBody">
                                </tbody>
                        </table>
                        <div id="noProjects" class="hidden text-center py-8 text-gray-400">
                            <i class="fa-solid fa-folder-open text-3xl mb-2"></i>
                            <p>No active projects</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    
                    <div class="section-card">
                        <div class="section-header">
                            <div class="section-title">Upcoming Events</div>
                            <a href="calendar.php" class="view-all">View Calendar</a>
                        </div>
                        <div id="eventsList">
                            </div>
                        <div id="noEvents" class="hidden text-center py-4 text-gray-400">
                            <p>No upcoming events</p>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-header">
                            <div class="section-title">Team</div>
                            <a href="team.php" class="view-all">Manage</a>
                        </div>
                        <div class="team-preview" id="teamList">
                            </div>
                    </div>

                </div>
            </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
    
        <div class="section-card lg:col-span-1 flex flex-col">
            <div class="section-header">
                <div class="section-title">Project Overview</div>
            </div>
            
            <div class="relative flex-1 flex flex-col items-center justify-center min-h-[250px]">
                <div class="relative w-48 h-48">
                    <canvas id="statusChart"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-3xl font-bold text-gray-800" id="chartTotal">0</span>
                        <span class="text-xs text-gray-400 uppercase font-semibold">Projects</span>
                    </div>
                </div>
            </div>

            <div id="chartLegend" class="mt-4 space-y-3 px-4">
                </div>
        </div>

        <div class="section-card lg:col-span-2">
            <div class="section-header">
                <div class="section-title">Latest Project Activity</div>
            </div>
            <div class="overflow-y-auto h-[500px] pr-2 pb-4 custom-scrollbar" id="recentActivityList">
                <div class="text-center text-gray-400 py-10">Loading activity...</div>
            </div>
        </div>

    </div>

  

    

        </div>
    </div>

<script>
        // --- 1. METAVLITES ---
        let unreadCount = 0;
        let isFirstLoad = true;

        // --- 2. KENTRIKI LEITOURGIA (POLLING) ---
        function startPolling() {
            // Φορτώνουμε ειδοποιήσεις
            fetchNotifications();
            // Ξεκινάμε το χρονόμετρο για ειδοποιήσεις κάθε 5 δευτερόλεπτα
            setInterval(fetchNotifications, 5000);
            
            // Φορτώνουμε τα δεδομένα του Dashboard (Projects, Events, Team)
            loadDashboardData(); 
        }

        // --- 3. NOTIFICATION LOGIC (NEW) ---
        
        // Λήψη ειδοποιήσεων από τη βάση
        async function fetchNotifications() {
            try {
                const response = await fetch('notification_handler.php?action=getNotifications');
                const data = await response.json();
                
                // Αν έχουμε νέα ειδοποίηση που δεν είχαμε πριν
                if (data.unread_count > unreadCount && !isFirstLoad) {
                    showToast('New Notification Received!', 'fa-bell');
                    // Αν έρθει κάτι νέο, ξαναφορτώνουμε και τους πίνακες
                    loadDashboardData(); 
                }

                unreadCount = data.unread_count;
                updateBadgeDisplay();
                renderNotifications(data.notifications);
                
                isFirstLoad = false;
            } catch (error) { console.error("Notif error:", error); }
        }

        // Εμφάνιση λίστας ειδοποιήσεων
        function renderNotifications(items) {
            const list = document.getElementById('notifList');
            
            if (items.length === 0) {
                list.innerHTML = '<div class="p-4 text-center text-gray-400 text-sm">No notifications</div>';
                return;
            }

            list.innerHTML = '';
            items.forEach(item => {
                const isUnread = item.is_read == 0;
                const statusClass = isUnread ? 'unread' : 'read';
                const iconClass = item.type === 'project' ? 'fa-layer-group' : 'fa-calendar-check';
                
                const div = document.createElement('div');
                // Όταν κάνεις κλικ: Διαβάζεται και σε πάει στο link
                div.onclick = (e) => handleNotificationClick(e, item.id, item.link);
                div.className = `notif-item ${statusClass}`;
                
                div.innerHTML = `
                    <div class="notif-icon">
                        <i class="fa-solid ${iconClass}"></i>
                    </div>
                    <div class="notif-content">
                        <h4>${item.title}</h4>
                        <p>${item.message}</p>
                        <span class="notif-time">${timeSince(item.created_at)}</span>
                    </div>
                `;
                list.appendChild(div);
            });
        }

        // Κλικ σε μια ειδοποίηση
        async function handleNotificationClick(e, id, link) {
            try {
                const formData = new FormData();
                formData.append('id', id);
                await fetch('notification_handler.php?action=markRead', {
                    method: 'POST',
                    body: formData
                });
                
                fetchNotifications(); // Ανανέωση UI
                window.location.href = link; // Ανακατεύθυνση
                
            } catch (error) { console.error(error); }
        }

        // Mark All Read
        async function clearNotifications() {
            try {
                await fetch('notification_handler.php?action=markAllRead');
                fetchNotifications(); 
            } catch (error) { console.error(error); }
        }

        // Ενημέρωση Κόκκινου Κύκλου (Badge)
        function updateBadgeDisplay() {
            const badge = document.getElementById('notifBadge');
            if (unreadCount > 0) {
                badge.style.display = 'flex';
                badge.innerText = unreadCount > 9 ? '9+' : unreadCount;
            } else {
                badge.style.display = 'none';
            }
        }

        // Helper: Υπολογισμός χρόνου (π.χ. "5 mins ago")
        function timeSince(dateString) {
            const date = new Date(dateString.replace(' ', 'T'));
            const seconds = Math.floor((new Date() - date) / 1000);
            let interval = seconds / 31536000;
            if (interval > 1) return Math.floor(interval) + " years ago";
            interval = seconds / 2592000;
            if (interval > 1) return Math.floor(interval) + " months ago";
            interval = seconds / 86400;
            if (interval > 1) return Math.floor(interval) + " days ago";
            interval = seconds / 3600;
            if (interval > 1) return Math.floor(interval) + " hours ago";
            interval = seconds / 60;
            if (interval > 1) return Math.floor(interval) + " mins ago";
            return Math.floor(seconds) + " secs ago";
        }

        // --- 4. DASHBOARD DATA LOADING (PROJECTS, EVENTS, TEAM) ---
        async function loadDashboardData() {
                 // Projects
            try {
                const pResponse = await fetch('project_handler.php?action=getProjects');
                const projects = await pResponse.json();
                
                document.getElementById('totalProjects').innerText = projects.length;
                renderRecentProjects(projects);
                
                // --- ΝΕΕΣ ΠΡΟΣΘΗΚΕΣ ---
                renderProjectChart(projects); // Φτιάξε το γράφημα
                renderActivityFeed(projects); // Φτιάξε τη λίστα δραστηριότητας
                // ----------------------

            } catch (e) { console.error("Error loading projects", e); }
            // Projects
            try {
                const pResponse = await fetch('project_handler.php?action=getProjects');
                const projects = await pResponse.json();
                document.getElementById('totalProjects').innerText = projects.length;
                renderRecentProjects(projects);
            } catch (e) { console.error("Error loading projects", e); }

            // Events
            try {
                const cResponse = await fetch('calendar_handler.php?action=getEvents');
                const events = await cResponse.json();
                const upcoming = events.filter(e => new Date(e.start_date) >= new Date().setHours(0,0,0,0));
                upcoming.sort((a, b) => new Date(a.start_date) - new Date(b.start_date));
                document.getElementById('totalEvents').innerText = upcoming.length;
                renderUpcomingEvents(upcoming);
            } catch (e) { console.error("Error loading events", e); }

            // Team
            try {
                const tResponse = await fetch('team_handler.php?action=getMembers');
                const members = await tResponse.json();
                const activeMembers = members.filter(m => m.status === 'active');
                document.getElementById('totalTeam').innerText = activeMembers.length;
                renderTeam(activeMembers);
            } catch (e) { console.error("Error loading team", e); }
        }

        // Render Projects Table
        function renderRecentProjects(projects) {
            const tbody = document.getElementById('projectTableBody');
            tbody.innerHTML = '';
            const recent = projects.slice(0, 5);
            
            if (recent.length === 0) {
                document.getElementById('noProjects').classList.remove('hidden');
                document.getElementById('projectTable').classList.add('hidden');
                return;
            } else {
                document.getElementById('noProjects').classList.add('hidden');
                document.getElementById('projectTable').classList.remove('hidden');
            }

            recent.forEach(p => {
                const statusColor = p.status === 'active' ? 'status-active' : 
                                    p.status === 'completed' ? 'status-completed' : 'status-planning';
                const statusText = p.status.charAt(0).toUpperCase() + p.status.slice(1);

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="font-medium text-gray-800">${p.name}</td>
                    <td><span class="status-dot ${statusColor}"></span>${statusText}</td>
                    <td>${p.date}</td>
                    <td><div class="flex -space-x-2">${generateAvatars(p.members)}</div></td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Render Avatars
        function generateAvatars(count) {
            let html = '';
            for(let i=0; i< Math.min(count, 3); i++) {
                const color = ['#6366f1', '#ec4899', '#10b981', '#f59e0b'][i % 4];
                html += `<div style="width:24px; height:24px; border-radius:50%; background:${color}; border:2px solid white; display:flex; align-items:center; justify-content:center; color:white; font-size:10px;">U${i+1}</div>`;
            }
            if(count > 3) html += `<div style="width:24px; height:24px; border-radius:50%; background:#94a3b8; border:2px solid white; display:flex; align-items:center; justify-content:center; color:white; font-size:9px;">+${count-3}</div>`;
            return html;
        }

        // Render Events List
        function renderUpcomingEvents(events) {
            const list = document.getElementById('eventsList');
            list.innerHTML = '';
            const topEvents = events.slice(0, 4);

            if(topEvents.length === 0) {
                document.getElementById('noEvents').classList.remove('hidden');
                return;
            }

            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            topEvents.forEach(e => {
                const date = new Date(e.start_date);
                const item = document.createElement('div');
                item.className = 'event-item';
                item.innerHTML = `
                    <div class="event-date-box">
                        <span class="event-day">${date.getDate()}</span>
                        <span class="event-month">${monthNames[date.getMonth()]}</span>
                    </div>
                    <div class="event-details">
                        <h4>${e.title} <span class="event-badge">${e.event_type}</span></h4>
                        <p>${e.start_time ? e.start_time.substring(0, 5) : 'All Day'} • ${e.project_name || 'No Project'}</p>
                    </div>
                `;
                list.appendChild(item);
            });
        }

        // Render Team List
        function renderTeam(members) {
            const container = document.getElementById('teamList');
            container.innerHTML = '';
            members.slice(0, 8).forEach(m => {
                const initials = m.name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                const div = document.createElement('div');
                div.className = 'mini-avatar';
                div.textContent = initials;
                container.appendChild(div);
            });
            const addBtn = document.createElement('a');
            addBtn.href = "team.php";
            addBtn.className = 'mini-avatar';
            addBtn.style.border = '1px dashed #cbd5e1';
            addBtn.style.background = 'transparent';
            addBtn.style.color = '#4c64ff';
            addBtn.innerHTML = '<i class="fa-solid fa-plus"></i>';
            container.appendChild(addBtn);
        }

        // --- 5. UI HELPERS & INITIALIZATION ---

        // Toggle Notification Menu
        function toggleNotifications() {
            const dropdown = document.getElementById('notifDropdown');
            dropdown.classList.toggle('active');
        }

        // Toast Message
        function showToast(message, iconClass) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `<i class="fa-solid ${iconClass}"></i><span class="toast-msg">${message}</span>`;
            container.appendChild(toast);
            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400);
            }, 4000);
        }

        // Close Dropdowns on Click Outside
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('notifBtn');
            const dropdown = document.getElementById('notifDropdown');
            if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Mobile Sidebar & Start App
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Sidebar
            const menuButton = document.getElementById('menu-button');
            const sidebar = document.getElementById('sidebar');
            if (menuButton && sidebar) {
                menuButton.addEventListener('click', (e) => { e.stopPropagation(); sidebar.classList.toggle('-translate-x-full'); });
                document.addEventListener('click', (e) => { if (!sidebar.classList.contains('-translate-x-full') && !sidebar.contains(e.target) && window.innerWidth < 1024) sidebar.classList.add('-translate-x-full'); });
            }
            
            // ΞΕΚΙΝΑΜΕ ΤΗΝ ΕΦΑΡΜΟΓΗ
            startPolling(); 
        });



                // --- 1. RENDER CHART FUNCTION ---
        let statusChartInstance = null;



        function renderProjectChart(projects) {
            const ctx = document.getElementById('statusChart').getContext('2d');
            
            // Υπολογισμοί
            const total = projects.length;
            const active = projects.filter(p => p.status === 'active').length;
            const planning = projects.filter(p => p.status === 'planning').length;
            const completed = projects.filter(p => p.status === 'completed').length;
            
            // Ενημέρωση κεντρικού αριθμού
            document.getElementById('chartTotal').innerText = total;

            // Destroy αν υπάρχει ήδη
            if (statusChartInstance) {
                statusChartInstance.destroy();
            }

            // Δημιουργία Chart
            statusChartInstance = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Planning', 'Completed'],
                    datasets: [{
                        data: [active, planning, completed],
                        backgroundColor: ['#10b981', '#f59e0b', '#3b82f6'],
                        borderWidth: 0,
                        hoverOffset: 10 // Πιο έντονο hover effect
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '85%', // Πιο λεπτό δαχτυλίδι (πιο μοντέρνο)
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 2000, // Πιο αργό/smooth animation
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#1f2937',
                            bodyColor: '#1f2937',
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    let value = context.raw;
                                    let percentage = total > 0 ? Math.round((value / total) * 100) + '%' : '0%';
                                    return ` ${context.label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Δημιουργία Custom Legend με Μπάρες Ποσοστών
            const legendContainer = document.getElementById('chartLegend');
            legendContainer.innerHTML = '';
            
            const statuses = [
                { label: 'Active', count: active, color: 'bg-emerald-500', text: 'text-emerald-700', bg: 'bg-emerald-50' },
                { label: 'Planning', count: planning, color: 'bg-amber-500', text: 'text-amber-700', bg: 'bg-amber-50' },
                { label: 'Completed', count: completed, color: 'bg-blue-500', text: 'text-blue-700', bg: 'bg-blue-50' }
            ];

            statuses.forEach(s => {
                const pct = total > 0 ? Math.round((s.count / total) * 100) : 0;
                const html = `
                    <div class="flex items-center justify-between text-sm mb-1">
                        <span class="font-bold text-gray-700 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full ${s.color}"></span> ${s.label}
                        </span>
                        <span class="font-bold ${s.text}">${pct}% <span class="text-gray-400 font-normal text-xs">(${s.count})</span></span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mb-3">
                        <div class="${s.color} h-1.5 rounded-full" style="width: ${pct}%"></div>
                    </div>
                `;
                legendContainer.innerHTML += html;
            });
        }

        // --- 2. RENDER ACTIVITY (Έντονα Σχόλια & Γραμμή) ---
        function renderActivityFeed(projects) {
            const container = document.getElementById('recentActivityList');
            let allComments = [];

            projects.forEach(p => {
                if (p.comments && p.comments.length > 0) {
                    p.comments.forEach(c => {
                        allComments.push({
                            project: p.name,
                            author: c.author,
                            text: c.text,
                            date: c.date
                        });
                    });
                }
            });

            if (allComments.length === 0) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full text-gray-400">
                        <i class="fa-regular fa-comment-dots text-3xl mb-2"></i>
                        <p>No recent activity</p>
                    </div>`;
                return;
            }

            // Παίρνουμε τα τελευταία 10
            const recentComments = allComments.slice(0, 10); 

            container.innerHTML = '';
            recentComments.forEach(c => {
                const initials = c.author.slice(0, 2).toUpperCase();
                
                const item = document.createElement('div');
                // ΕΔΩ ΕΙΝΑΙ Η ΓΡΑΜΜΗ (border-b):
                item.className = 'flex gap-4 mb-5 pb-5 border-b border-gray-100 last:border-0 last:mb-0 last:pb-0 hover:bg-gray-50 p-2 rounded-lg transition-colors';
                
                item.innerHTML = `
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-md">
                        ${initials}
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-1">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900">${c.author}</span>
                                <span class="text-xs text-primary-blue font-semibold bg-blue-50 px-2 py-0.5 rounded w-fit mt-1">
                                ${c.project}
                                </span>
                            </div>
                            <span class="text-xs font-medium text-gray-400 whitespace-nowrap bg-gray-50 px-2 py-1 rounded border border-gray-100">
                                ${c.date}
                            </span>
                        </div>
                        <p class="text-sm text-gray-700 font-medium leading-relaxed mt-2 pl-2 border-l-2 border-indigo-100">
                            "${c.text}"
                        </p>
                    </div>
                `;
                container.appendChild(item);
            });
        }
</script>
    <div class="toast-container" id="toastContainer"></div>
</body>
</html>
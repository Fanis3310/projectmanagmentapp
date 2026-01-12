<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dashboard</title>
    <!-- Font Awesome for Icons -->
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
                        'text-secondary': '#6b7280',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
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
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            padding: 20px;
            flex-shrink: 0;
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

        /* Search Box */
        .search-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input {
            display: none;
            position: absolute;
            right: 0;
            width: 300px;
            padding: 8px 35px 8px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            outline: none;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .search-input.active {
            display: block;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .search-input:focus {
            border-color: var(--primary-color);
        }

        /* --- PROJECT GRID --- */
        .content-area {
            padding: 30px;
            overflow-y: auto;
            height: 100%;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .project-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .project-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.08);
            border-color: var(--primary-color);
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
            align-items: center;
            margin-bottom: 15px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active { background: #e0f7fa; color: #0097a7; }
        .status-planning { background: #fff3e0; color: #f59e0b; }
        .status-completed { background: #e8f5e9; color: #10b981; }

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
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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

        .project-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .project-desc {
            font-size: 14px;
            color: var(--text-light);
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .info-badges {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .info-badge {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            background: #f0f4ff;
            color: var(--primary-color);
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            padding-top: 15px;
            font-size: 13px;
            color: var(--text-light);
        }

        .avatars {
            display: flex;
        }
        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #dfe6e9;
            border: 2px solid var(--white);
            margin-left: -10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }
        .avatar:first-child { margin-left: 0; }

        /* --- MODAL / POPUP --- */
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

        .modal-content.expanded {
            width: 900px;
            max-width: 95vw;
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
            z-index: 10;
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .modal-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
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

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .form-textarea {
            resize: none;
            height: 80px;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--primary-color);
        }

        /* Files and Comments in Modal Basic View */
        .modal-files-section, .modal-comments-section {
            margin-top: 20px;
            padding: 15px;
            background: #dfe6e9;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background: white;
            border-radius: 6px;
            margin-bottom: 8px;
            border: 1px solid #e5e7eb;
        }

        .modal-file-item:last-child {
            margin-bottom: 0;
        }

        .modal-file-name {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-dark);
            flex: 1;
        }

        .modal-file-name i {
            color: var(--primary-color);
        }

        .modal-download-btn {
            color: var(--primary-color);
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 4px;
            transition: 0.2s;
            font-size: 14px;
        }

        .modal-download-btn:hover {
            background: #e0e7ff;
        }

        .modal-comment-item {
            padding: 10px;
            background: white;
            border-radius: 6px;
            margin-bottom: 8px;
            border: 1px solid #e5e7eb;
        }

        .modal-comment-item:last-child {
            margin-bottom: 0;
        }

        .modal-comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .modal-comment-author {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 13px;
        }

        .modal-comment-date {
            font-size: 11px;
            color: var(--text-light);
        }

        .modal-comment-text {
            color: var(--text-dark);
            font-size: 14px;
            line-height: 1.5;
        }

        .empty-state {
            text-align: center;
            color: var(--text-light);
            font-size: 13px;
            padding: 15px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
            grid-column: 1 / -1;
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

        .btn-full-view {
            background: transparent;
            color: var(--primary-color);
            border: 1px dashed var(--primary-color);
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: auto;
        }

        /* User selection */
        .user-list {
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 10px;
            max-height: 200px;
            overflow-y: auto;
        }

        .user-item {
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.2s;
        }

        .user-item:hover {
            background-color: #f5f7fa;
        }

        .user-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .selected-users {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .user-tag {
            background: #e0f7fa;
            color: #0097a7;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .user-tag .remove {
            cursor: pointer;
            font-weight: bold;
        }

        /* Comments section in expanded view */
        .comments-section {
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 15px;
            max-height: 300px;
            overflow-y: auto;
        }

        .comment-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .comment-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .comment-author {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
        }

        .comment-date {
            font-size: 12px;
            color: var(--text-light);
        }

        .comment-text {
            font-size: 14px;
            color: var(--text-dark);
            line-height: 1.5;
        }

        .comment-input-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .comment-input {
            flex: 1;
        }

        /* File upload */
        .file-upload-area {
            border: 2px dashed var(--border);
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background-color: #f5f7fa;
        }

        .file-upload-area input[type="file"] {
            display: none;
        }

        .uploaded-files {
            margin-top: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background: #f5f7fa;
            border-radius: 6px;
            margin-bottom: 8px;
        }

        .file-item i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .file-remove {
            cursor: pointer;
            color: #ef4444;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 3px;
        }

        .sidebar {
            transition: transform 0.3s ease-in-out;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 50;
                position: fixed;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .modal-columns {
                grid-template-columns: 1fr;
            }
        }
        

        .hidden {
            display: none !important;
        }

        /* No results message */
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

        .no-results p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .no-results small {
            font-size: 14px;
        }

            /* Disabled user checkbox style */
        .user-item input[type="checkbox"]:disabled {
            cursor: not-allowed;
        }

        .user-item input[type="checkbox"]:disabled + label {
            opacity: 0.6;
            cursor: not-allowed;
        }

            /* ========================================
        MOBILE HEADER & SEARCH FIX
        ======================================== */
        @media (max-width: 768px) {
            
          
            header .max-w-7xl {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 5px; 
                position: relative; 
            }

          
            header h1.text-2xl {
                font-size: 18px !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                margin-right: auto;
            }

         
            header .flex.items-center.space-x-4 > button:first-child {
                display: none !important;
            }

          
            #new-project-button {
                padding: 8px 12px !important;
                font-size: 15px !important; 
                width: auto !important;
                display: flex !important;
                align-items: center !important;
            }
            
            #new-project-button svg {
                margin-right: 5px !important; 
            }

          
            .search-container {
                position: static; 
            }

            .search-input {
                width: 90% !important; 
                left: 5% !important;   
                top: 70px !important;  
                right: auto !important;
                position: fixed;       
                z-index: 100;         
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                border: 1px solid #4c64ff;
            }
        }

    </style>
</head>
<body class="bg-light-bg font-sans min-h-screen flex">

    <!-- Sidebar / Left Navigation -->
    <div id="sidebar" class="sidebar fixed inset-y-0 left-0 w-64 bg-sidebar-bg p-4 flex flex-col border-r border-gray-100 lg:relative lg:translate-x-0 transform -translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
        <div class="mb-8 font-bold text-xl text-primary-blue">
            Project
        </div>

        <nav class="flex-grow">
            <div class="text-xs font-semibold uppercase text-text-secondary mb-2">Menu</div>
            <a href="index.php" id="nav-home" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Home
            </a>
            <a href="project.php" id="nav-projects" class="nav-link flex items-center p-3 rounded-xl bg-indigo-50 text-primary-blue font-medium mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Projects
            </a>
            <a href="calendar.php" id="nav-calendar" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Calendar
            </a>
            <a href="#" class="flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                My Tasks
            </a>
            <a href="#" class="nav-link flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                Notifications
            </a>
            <a href="#" class="flex items-center p-3 rounded-xl text-text-secondary hover:bg-light-bg mb-1">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2 4v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7"></path></svg>
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

    <!-- Main Content Area -->
    <div id="main-content" class="flex-1 flex flex-col lg:ml-0 transition-all duration-300">
        <header class="bg-card-bg p-4 sticky top-0 z-40 shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <button id="menu-button" class="lg:hidden p-2 rounded-md text-text-primary mr-3 hover:bg-light-bg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h1 id="page-title" class="text-2xl font-semibold text-text-primary">Projects</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 rounded-full text-text-secondary hover:bg-light-bg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>

                    <!-- Search Container -->
                    <div class="search-container">
                        <button id="searchBtn" class="p-2 rounded-full text-text-secondary hover:bg-light-bg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                        <input type="text" id="searchInput" class="search-input" placeholder="Search projects...">
                    </div>

                    <button id="new-project-button" class="flex items-center bg-primary-blue text-white py-2 px-4 rounded-xl font-medium shadow-md hover:bg-indigo-700 transition duration-150" onclick="openModal()">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        New Project
                    </button>
                </div>
            </div>
        </header>

        <!-- PROJECT GRID -->
        <div class="content-area">
            <div class="projects-grid" id="projectGrid">
                <!-- Projects will be inserted here by JavaScript -->
            </div>
            <div id="noResults" class="no-results hidden">
                <i class="fa-solid fa-magnifying-glass"></i>
                <p>No projects found</p>
                <small>Try searching for something else</small>
            </div>
        </div>
    </div>

    <!-- MODAL POPUP -->
    <div class="modal-overlay" id="projectModal">
        <div class="modal-content" id="modalContentBox">
            <i class="fa-solid fa-xmark close-modal" onclick="closeModal()"></i>
            <div class="modal-title" id="modalTitle">Project Details</div>

            <form id="projectForm">
                <!-- Basic Info -->
                <div id="basicInfo">
                    <div class="form-group">
                        <label class="form-label">Project Name</label>
                        <input type="text" class="form-input" id="inputName" placeholder="Enter project name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="inputStatus">
                            <option value="active">In Progress</option>
                            <option value="planning">Planning</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-textarea" id="inputDesc" placeholder="Description..."></textarea>
                    </div>

                    <!-- Files Section -->
                    <div class="modal-files-section" id="modalFilesView">
                        <div class="section-title">
                            <i class="fa-solid fa-folder-open"></i>
                            Project Files
                        </div>
                        <div id="modalFilesList"></div>
                    </div>

                    <!-- Comments Section -->
                    <div class="modal-comments-section" id="modalCommentsView">
                        <div class="section-title">
                            <i class="fa-solid fa-comments"></i>
                            Comments
                        </div>
                        <div id="modalCommentsList"></div>
                    </div>
                </div>

                <!-- Extended Info -->
                <div id="extendedInfo" class="hidden modal-columns">
                    <div>
                        <div class="form-group">
                            <label class="form-label">Add Team Members</label>
                            <div class="user-list" id="userList"></div>
                            <div class="selected-users" id="selectedUsers"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Upload Files</label>
                            <div class="file-upload-area" onclick="document.getElementById('fileInput').click()">
                                <input type="file" id="fileInput" multiple onchange="handleFileSelect(event)">
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 32px; color: #4c64ff;"></i>
                                <p style="margin-top: 10px; color: #636e72;">Click to upload files</p>
                            </div>
                            <div class="uploaded-files" id="uploadedFiles"></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="form-label">Add Comments</label>
                            <div class="comments-section" id="commentsSection"></div>
                            <div class="comment-input-group">
                                <input type="text" class="form-input comment-input" id="commentInput" placeholder="Add a comment...">
                                <button type="button" class="btn-primary" onclick="addComment()">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-full-view" id="toggleDetailsBtn" onclick="toggleDetails()">
                        <i class="fa-solid fa-up-right-from-square"></i> <span id="toggleBtnText">Add More Details</span>
                    </button>
                    <button type="button" class="btn-outline" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-primary" onclick="saveProject()">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sample Data

        // --- MOBILE SIDEBAR LOGIC ---
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menu-button');
            const sidebar = document.getElementById('sidebar');

            if (menuButton && sidebar) {
                // Toggle Menu
                menuButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    sidebar.classList.toggle('-translate-x-full');
                });

                // Close when clicking outside
                document.addEventListener('click', (e) => {
                    if (!sidebar.classList.contains('-translate-x-full') && 
                        !sidebar.contains(e.target) && 
                        window.innerWidth < 1024) {
                        sidebar.classList.add('-translate-x-full');
                    }
                });
            }
        });


     let projects = [];

  
     async function loadProjects() {
        try {
           const response = await fetch('project_handler.php?action=getProjects');
           const data = await response.json();
            projects = data;
            renderProjects();
        } catch (error) {
              console.error('Error loading projects:', error);
               alert('Failed to load projects from database!');
        }
     }

    
        window.addEventListener('DOMContentLoaded', loadProjects);

    
        let availableUsers = [];

    
        async function loadTeamMembers() {
            try {
                const response = await fetch('team_handler.php?action=getMembers');
                const data = await response.json();
                
                console.log('Raw data from API:', data); 
                
             
                availableUsers = data.map(member => ({
                    id: member.id,
                    name: member.name,
                    status: member.status || 'active'  
                }));
                
                console.log('Mapped availableUsers:', availableUsers); 
            } catch (error) {
                console.error('Error loading team members:', error);
            }
        }




        const grid = document.getElementById('projectGrid');
        const modal = document.getElementById('projectModal');
        const modalContent = document.getElementById('modalContentBox');
        const nameInput = document.getElementById('inputName');
        const statusInput = document.getElementById('inputStatus');
        const descInput = document.getElementById('inputDesc');
        const modalTitle = document.getElementById('modalTitle');
        const extendedInfo = document.getElementById('extendedInfo');
        const toggleBtnText = document.getElementById('toggleBtnText');
        const searchInput = document.getElementById('searchInput');
        const searchBtn = document.getElementById('searchBtn');
        const noResults = document.getElementById('noResults');
        const searchContainer = document.querySelector('.search-container');

        let currentId = null;
        let isExpanded = false;
        let selectedUserIds = [];
        let projectComments = [];
        let projectFiles = [];
        let currentDropdown = null;

        // Search functionality - Opens on click
        searchBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            searchInput.classList.add('active');
            searchInput.focus();
        });

        // Close search when clicking outside or when input loses focus
        searchInput.addEventListener('blur', function() {
            // Delay to allow click events to register
            setTimeout(() => {
                searchInput.classList.remove('active');
                searchInput.value = '';
                renderProjects(); // Reset to show all projects
            }, 200);
        });

        // Real-time search as user types
        searchInput.addEventListener('input', function() {
            searchProjects();
        });

        function searchProjects() {
            const searchTerm = searchInput.value.toLowerCase().trim();

            if (searchTerm === '') {
                renderProjects();
                return;
            }

            const filteredProjects = projects.filter(project => 
                project.name.toLowerCase().includes(searchTerm) ||
                project.desc.toLowerCase().includes(searchTerm) ||
                project.status.toLowerCase().includes(searchTerm)
            );

            renderProjects(filteredProjects);
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (currentDropdown && !e.target.closest('.dropdown')) {
                currentDropdown.classList.remove('active');
                currentDropdown = null;
            }
        });

        // Toggle dropdown
        function toggleDropdown(event, projectId) {
            event.stopPropagation();

            const dropdown = event.currentTarget.nextElementSibling;

            if (currentDropdown && currentDropdown !== dropdown) {
                currentDropdown.classList.remove('active');
            }

            dropdown.classList.toggle('active');
            currentDropdown = dropdown.classList.contains('active') ? dropdown : null;
        }

        // Delete project
        async function deleteProject(event, projectId) {
            event.stopPropagation();
            
            if (confirm('Are you sure you want to delete this project?')) {
                try {
                    const response = await fetch('project_handler.php?action=deleteProject', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({id: projectId})
                    });
                    const result = await response.json();
                    
                    if (result.success) {
                        await loadProjects(); 
                    } else {
                        alert('Failed to delete project!');
                    }
                } catch (error) {
                    console.error('Error deleting project:', error);
                    alert('Failed to delete project!');
                }
                
                // Close dropdown
                if (currentDropdown) {
                    currentDropdown.classList.remove('active');
                    currentDropdown = null;
                }
            }
        }


        // Render Projects to Grid
        function renderProjects(projectList = projects) {
            grid.innerHTML = '';

            if (projectList.length === 0) {
                grid.style.display = 'none';
                noResults.classList.remove('hidden');
                return;
            }

            grid.style.display = 'grid';
            noResults.classList.add('hidden');

            projectList.forEach(project => {
                const badgeClass = `status-${project.status}`;
                const statusText = project.status === 'active' ? 'In Progress' : project.status.charAt(0).toUpperCase() + project.status.slice(1);

                const card = document.createElement('div');
                card.className = 'project-card';
                card.onclick = () => openModal(project);

                let infoBadges = '';
                if (project.files && project.files.length > 0) {
                    infoBadges += `<div class="info-badge"><i class="fa-solid fa-paperclip"></i> ${project.files.length} file${project.files.length > 1 ? 's' : ''}</div>`;
                }
                if (project.comments && project.comments.length > 0) {
                    infoBadges += `<div class="info-badge"><i class="fa-solid fa-comment"></i> ${project.comments.length} comment${project.comments.length > 1 ? 's' : ''}</div>`;
                }

                card.innerHTML = `
                    <div class="card-header">
                        <div class="status-badge ${badgeClass}">${statusText}</div>
                        <div class="dropdown">
                            <div class="dropdown-toggle" onclick="toggleDropdown(event, ${project.id})">
                                <i class="fa-solid fa-ellipsis" style="color: #b2bec3;"></i>
                            </div>
                            <div class="dropdown-menu">
                                <div class="dropdown-item" onclick="openModal(${JSON.stringify(project).replace(/"/g, '&quot;')})">
                                    <i class="fa-solid fa-pen"></i>
                                    Edit
                                </div>
                                <div class="dropdown-item delete" onclick="deleteProject(event, ${project.id})">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-title">${project.name}</div>
                    <div class="project-desc">${project.desc}</div>
                    ${infoBadges ? '<div class="info-badges">' + infoBadges + '</div>' : ''}
                    <div class="card-footer">
                        <div class="avatars">
                            ${generateAvatars(project.members)}
                        </div>
                        <div><i class="fa-regular fa-clock"></i> ${project.date}</div>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        function generateAvatars(count) {
            let html = '';
            for(let i=0; i< Math.min(count, 3); i++) {
                html += `<div class="avatar" style="background:#${Math.floor(Math.random()*16777215).toString(16)}">U${i+1}</div>`;
            }
            if(count > 3) html += `<div class="avatar">+${count-3}</div>`;
            return html;
        }

        function loadModalFiles() {
            const container = document.getElementById('modalFilesList');
            container.innerHTML = '';

            if (projectFiles.length === 0) {
                container.innerHTML = '<div class="empty-state">No files uploaded yet</div>';
                return;
            }

            projectFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'modal-file-item';
                fileItem.innerHTML = `
                    <div class="modal-file-name">
                        <i class="fa-solid fa-file"></i>
                        <span>${file.name}</span>
                        <span style="color: #636e72; font-size: 12px;">(${file.size})</span>
                    </div>
                    <div class="modal-download-btn" onclick="downloadFile(${index})">
                        <i class="fa-solid fa-download"></i> Download
                    </div>
                `;
                container.appendChild(fileItem);
            });
        }

        function loadModalComments() {
            const container = document.getElementById('modalCommentsList');
            container.innerHTML = '';

            if (projectComments.length === 0) {
                container.innerHTML = '<div class="empty-state">No comments yet</div>';
                return;
            }

            projectComments.forEach(comment => {
                const commentItem = document.createElement('div');
                commentItem.className = 'modal-comment-item';
                commentItem.innerHTML = `
                    <div class="modal-comment-header">
                        <span class="modal-comment-author">${comment.author}</span>
                        <span class="modal-comment-date">${comment.date}</span>
                    </div>
                    <div class="modal-comment-text">${comment.text}</div>
                `;
                container.appendChild(commentItem);
            });
        }

        function downloadFile(fileIndex) {
            const file = projectFiles[fileIndex];
            if (!file) {
                alert("File not found");
                return;
            }

            if (file.data) {
                const link = document.createElement('a');
                link.href = file.data;
                link.download = file.name;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                alert(`Downloading: ${file.name}\n\nIn production, this would download the actual file from your server.`);
            }
        }

        async function toggleDetails() {
            isExpanded = !isExpanded;
            
            if (isExpanded) {
                modalContent.classList.add('expanded');
                extendedInfo.classList.remove('hidden');
                toggleBtnText.textContent = 'Hide Details';
                
               
                await loadTeamMembers();
                
                loadUsers();
                loadComments();
                loadFiles();
            } else {
                modalContent.classList.remove('expanded');
                extendedInfo.classList.add('hidden');
                toggleBtnText.textContent = 'Add More Details';
            }
        }


        function loadUsers() {
            const userList = document.getElementById('userList');
            userList.innerHTML = '';
            
            availableUsers.forEach(user => {
                const userItem = document.createElement('div');
                userItem.className = 'user-item';
                
               
                const isSelected = selectedUserIds.includes(user.id);
                
             
                const isInactiveAssigned = user.status === 'inactive' && isSelected;
                
             
                const isInactiveNotAssigned = user.status === 'inactive' && !isSelected;
                
            
                if (isInactiveNotAssigned) {
                    return; // Skip this user
                }
                
                const isChecked = isSelected ? 'checked' : '';
                const isDisabled = isInactiveAssigned ? 'disabled' : '';
                const grayedStyle = isInactiveAssigned ? 'opacity: 0.5; cursor: not-allowed;' : '';
                const inactiveLabel = isInactiveAssigned ? ' <span style="color: #ef4444; font-size: 11px;">(Inactive)</span>' : '';
                
                userItem.innerHTML = `
                    <input type="checkbox" 
                        id="user-${user.id}" 
                        value="${user.id}" 
                        ${isChecked} 
                        ${isDisabled}
                        onchange="toggleUser(${user.id}, '${user.name}')">
                    <label for="user-${user.id}" style="${grayedStyle}">
                        ${user.name}${inactiveLabel}
                    </label>
                `;
                userList.appendChild(userItem);
            });
            
            updateSelectedUsers();
        }


        function toggleUser(userId, userName) {
            const index = selectedUserIds.indexOf(userId);
            if (index > -1) {
                selectedUserIds.splice(index, 1);
            } else {
                selectedUserIds.push(userId);
            }
            updateSelectedUsers();
        }

        function updateSelectedUsers() {
            const container = document.getElementById('selectedUsers');
            container.innerHTML = '';

            selectedUserIds.forEach(userId => {
                const user = availableUsers.find(u => u.id === userId);
                if (user) {
                    const tag = document.createElement('div');
                    tag.className = 'user-tag';
                    tag.innerHTML = `
                        ${user.name}
                        <span class="remove" onclick="toggleUser(${userId}, '${user.name}')">&times;</span>
                    `;
                    container.appendChild(tag);
                }
            });
        }

        function loadComments() {
            const commentsSection = document.getElementById('commentsSection');
            commentsSection.innerHTML = '';

            if (projectComments.length === 0) {
                commentsSection.innerHTML = '<p style="color: #636e72; text-align: center;">No comments yet</p>';
                return;
            }

            projectComments.forEach(comment => {
                const commentItem = document.createElement('div');
                commentItem.className = 'comment-item';
                commentItem.innerHTML = `
                    <div class="comment-header">
                        <span class="comment-author">${comment.author}</span>
                        <span class="comment-date">${comment.date}</span>
                    </div>
                    <div class="comment-text">${comment.text}</div>
                `;
                commentsSection.appendChild(commentItem);
            });
        }

        function addComment() {
            const commentInput = document.getElementById('commentInput');
            const text = commentInput.value.trim();

            if (!text) return;

            const comment = {
                author: "Current User",
                date: new Date().toLocaleString(),
                text: text,
                is_new: true  
            };

            projectComments.push(comment);
            commentInput.value = '';
            loadComments();
            loadModalComments();
        }

        function handleFileSelect(event) {
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    projectFiles.push({
                        name: file.name,
                        size: formatFileSize(file.size),
                        type: file.type,
                        data: e.target.result,
                        created_at: null, 
                        is_new: true      
                    });
                    loadFiles();
                    loadModalFiles();
                };

                reader.readAsDataURL(file);
            }
        }

        function loadFiles() {
            const container = document.getElementById('uploadedFiles');
            container.innerHTML = '';

            projectFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <div>
                        <i class="fa-solid fa-file"></i>
                        <span>${file.name}</span>
                        <span style="color: #636e72; font-size: 12px; margin-left: 8px;">(${file.size})</span>
                    </div>
                    <i class="fa-solid fa-xmark file-remove" onclick="removeFile(${index})"></i>
                `;
                container.appendChild(fileItem);
            });
        }

        function removeFile(index) {
            projectFiles.splice(index, 1);
            loadFiles();
            loadModalFiles();
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        async function openModal(project = null) {
            modal.classList.add('active');
            
            // Reset modal state
            isExpanded = false;
            modalContent.classList.remove('expanded');
            extendedInfo.classList.add('hidden');
            toggleBtnText.textContent = 'Add More Details';
            
            // Reset arrays
            selectedUserIds = [];
            projectComments = [];
            projectFiles = [];

            if (project) {
                // EDIT MODE
                currentId = project.id;
                modalTitle.innerText = 'Edit Project';
                
             
                nameInput.value = project.name;
                statusInput.value = project.status;
                descInput.value = project.desc;
                
              
                if (availableUsers.length === 0) {
                    await loadTeamMembers();
                }
                
            
                if (project.users && project.users.length > 0) {
                    selectedUserIds = availableUsers
                        .filter(u => project.users.includes(u.name))
                        .map(u => u.id);
                }
                
         
                if (project.comments && project.comments.length > 0) {
                    projectComments = JSON.parse(JSON.stringify(project.comments));
                }
                
           
                if (project.files && project.files.length > 0) {
                    projectFiles = JSON.parse(JSON.stringify(project.files));
                }
                
            } else {
                // NEW PROJECT MODE
                currentId = null;
                modalTitle.innerText = 'New Project';
                nameInput.value = '';
                statusInput.value = 'planning';
                descInput.value = '';
            }
            
         
            loadModalFiles();
            loadModalComments();
        }



        function closeModal() {
            modal.classList.remove('active');
            setTimeout(() => {
                isExpanded = false;
                modalContent.classList.remove('expanded');
                extendedInfo.classList.add('hidden');
            }, 300);
        }

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        // Μέσα στο index.php -> Αντικατάσταση της saveProject
    async function saveProject() {
        const name = nameInput.value;
        const desc = descInput.value;
        const status = statusInput.value;
        const members = selectedUserIds.length;
        const date = '';

        if (!name) {
            alert('Project Name is required');
            return;
        }

        const users = Array.from(document.querySelectorAll('#userList input:checked')).map(cb => cb.value);

        const projectData = {
            id: currentId,
            name: name,
            desc: desc,
            status: status,
            members: members,
            date: date,
            users: users,
            comments: projectComments.map(c => ({
                author: c.author,
                text: c.text,
                date: c.date,
                created_at: c.created_at || null
            })),
            files: projectFiles.map(f => ({
                name: f.name,
                size: f.size,
                created_at: f.created_at || null
            }))
        };

        try {
            const response = await fetch('project_handler.php?action=saveProject', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(projectData)
            });

            const result = await response.json();

            if (result.success) {
                closeModal();
                await loadProjects();
                
            } else {
                alert('Error saving project: ' + (result.error || 'Unknown error'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while saving.');
        }
    }



        

        // Initial Render
        //renderProjects();
    </script>  
</body>
</html>
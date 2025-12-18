<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
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
        --text-dark: #2d3436;
        --text-light: #636e72;
        --white: #ffffff;
        --border: #dfe6e9;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        
        /* Event colors */
        --task-color: #4c64ff;
        --meeting-color: #10b981;
        --reminder-color: #f59e0b;
        --deadline-color: #ef4444;
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

    /* ========================================
       SIDEBAR
       ======================================== */

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
        text-decoration: none;
        color: var(--text-light);
        font-size: 14px;
    }

    .menu-item:hover {
        background-color: #f3f4f6;
    }

    .menu-item.active {
        background-color: #e0e7ff;
        color: var(--primary-color);
    }

    .menu-item svg {
        flex-shrink: 0;
        width: 18px;
        height: 18px;
    }

    /* ========================================
       MAIN CONTENT
       ======================================== */

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

    /* ========================================
       CALENDAR HEADER
       ======================================== */

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        background: linear-gradient(135deg, #f5f7fa 0%, #ffffff 100%);
        padding: 25px 35px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .calendar-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ========================================
       CALENDAR NAVIGATION
       ======================================== */

    .calendar-nav {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .nav-btn {
        background: var(--white);
        color: var(--primary-color);
        border: 2px solid #e5e7eb;
        padding: 10px 18px;
        border-radius: 50px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .nav-btn:hover {
        background: var(--primary-color);
        color: var(--white);
        border-color: var(--primary-color);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 16px rgba(76, 100, 255, 0.25);
    }

    .nav-btn:active {
        transform: translateY(-1px) scale(0.98);
    }

    .nav-btn i {
        transition: transform 0.3s ease;
    }

    .nav-btn:hover i {
        transform: scale(1.2);
    }

    .nav-btn:hover .fa-chevron-left {
        transform: translateX(-3px) scale(1.2);
    }

    .nav-btn:hover .fa-chevron-right {
        transform: translateX(3px) scale(1.2);
    }

    .today-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: var(--white);
        border: none;
        padding: 10px 24px;
        font-weight: 700;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .today-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .today-btn:hover::before {
        left: 100%;
    }

    .today-btn:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(118, 75, 162, 0.4);
    }

    .today-btn:hover .fa-calendar-day {
        animation: bounce 0.6s ease;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }

    /* ========================================
       CALENDAR GRID
       ======================================== */

    .calendar-grid-container {
        background: var(--white);
        border-radius: 16px;
        padding: 20px;
        box-shadow: var(--shadow);
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        margin-bottom: 10px;
    }

    .weekday {
        text-align: center;
        font-weight: 700;
        font-size: 13px;
        color: var(--text-light);
        padding: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        min-height: 600px;
    }

    .calendar-day {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 12px;
        min-height: 120px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        border: 2px solid transparent;
    }

    .calendar-day:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-color);
    }

    .calendar-day.other-month {
        background: #fafafa;
        opacity: 0.4;
    }

    .calendar-day.today {
        background: #ddd6fe;
        color: var(--text-dark);
    }

    .calendar-day.today .day-number {
        color: var(--primary-color);
        font-weight: 700;
    }

    .calendar-day.today:hover {
        background: #c4b5fd;
        transform: translateY(-2px);
    }

    .calendar-day.has-events {
        border-left: 4px solid var(--primary-color);
    }

    .day-number {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .day-events {
        display: flex;
        flex-direction: column;
        gap: 4px;
        max-height: 70px;
        overflow: hidden;
    }

    /* ========================================
       EVENT DOTS
       ======================================== */

    .event-dot {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 6px;
        color: var(--white);
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: all 0.2s;
    }

    .event-dot:hover {
        opacity: 0.85;
        cursor: pointer;
    }

    .event-dot.task { background: var(--task-color); }
    .event-dot.meeting { background: var(--meeting-color); }
    .event-dot.reminder { background: var(--reminder-color); }
    .event-dot.deadline { background: var(--deadline-color); }

    .more-events {
        font-size: 10px;
        color: var(--primary-color);
        font-weight: 600;
        margin-top: 4px;
        text-align: center;
        background: rgba(76, 100, 255, 0.1);
        padding: 4px;
        border-radius: 4px;
        cursor: pointer;
    }

    .more-events:hover {
        background: rgba(76, 100, 255, 0.2);
    }

    /* ========================================
       MODALS - SINGLE CLEAN DEFINITION
       ======================================== */

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
    }

    /* Center modal using flexbox when display is flex */
    .modal[style*="display: flex"] {
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: var(--white);
        margin: auto;
        padding: 0;
        border-radius: 20px;
        max-width: 650px;
        width: 90%;
        max-height: 85vh;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        position: relative;
        animation: modalSlideIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        padding: 24px 30px;
        border-bottom: 2px solid #f3f4f6;
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        flex-shrink: 0;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 24px;
        color: var(--text-dark);
        font-weight: 700;
    }

    .modal-body {
        padding: 24px 30px;
        overflow-y: auto;
        overflow-x: hidden;
        flex: 1;
    }

    .modal-footer {
        padding: 20px 30px;
        border-top: 2px solid #f3f4f6;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        background: #fafafa;
        flex-shrink: 0;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 32px;
        color: #9ca3af;
        cursor: pointer;
        line-height: 1;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .close-modal:hover {
        background: #f3f4f6;
        color: var(--text-dark);
        transform: rotate(90deg);
    }

    .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }

    /* ========================================
       DAY MODAL SPECIFIC
       ======================================== */

    .day-modal-content {
        max-width: 900px !important;
        width: 95%;
    }

    .day-events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .day-event-card {
        background: var(--white);
        border-radius: 12px;
        padding: 20px;
        border-left: 4px solid #4c64ff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .day-event-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .day-event-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .day-event-time {
        font-size: 13px;
        color: var(--primary-color);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        background: rgba(76, 100, 255, 0.1);
        padding: 6px 12px;
        border-radius: 20px;
    }

    .day-event-time i {
        font-size: 12px;
    }

    .day-event-actions {
        display: flex;
        gap: 4px;
    }

    .event-action-btn {
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 6px 10px;
        border-radius: 8px;
        transition: all 0.2s;
        font-size: 14px;
    }

    .event-action-btn:hover {
        background: #f3f4f6;
        color: var(--primary-color);
    }

    .event-action-btn.delete:hover {
        color: #ef4444;
        background: #fef2f2;
    }

    .day-event-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.4;
    }

    .day-event-description {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
    }

    .day-event-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 13px;
        color: #9ca3af;
        padding-top: 8px;
        border-top: 1px solid #f3f4f6;
    }

    .day-event-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    #noEventsMessage {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }

    #noEventsMessage i {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.2;
        color: var(--primary-color);
    }

    #noEventsMessage p {
        font-size: 16px;
        font-weight: 500;
    }

    /* ========================================
       FORM STYLES
       ======================================== */

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s;
        box-sizing: border-box;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(76, 100, 255, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .checkbox-group input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .checkbox-group label {
        margin: 0;
        cursor: pointer;
        font-weight: 500;
    }

    /* ========================================
       BUTTONS
       ======================================== */

    .btn-outline {
        background: transparent;
        border: 2px solid #e5e7eb;
        padding: 12px 24px;
        border-radius: 10px;
        cursor: pointer;
        color: var(--text-dark);
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-outline:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background: rgba(76, 100, 255, 0.05);
    }

    .btn-primary {
        background: var(--primary-color);
        color: var(--white);
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(76, 100, 255, 0.3);
    }

    /* ========================================
       DROPDOWN
       ======================================== */

    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        cursor: pointer;
        padding: 6px;
        border-radius: 6px;
        transition: 0.2s;
    }

    .dropdown-toggle:hover {
        background: #e5e7eb;
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



     /* ========================================
       MOBILE RESPONSIVE (Κινητά)
       ======================================== */
    @media (max-width: 768px) {
        /* Αλλαγή διάταξης στο Calendar Header */
        .calendar-header {
            flex-direction: column;
            gap: 15px;
            padding: 15px;
        }

        .calendar-nav {
            width: 100%;
            justify-content: space-between;
        }

        /* --- MODAL MOBILE STYLES --- */
        
        /* 1. Το παράθυρο πιάνει σχεδόν όλη την οθόνη */
        .modal-content {
            width: 95% !important;
            max-width: 95% !important;
            max-height: 90vh !important;
            margin: auto;
        }

        /* 2. Τα πεδία μπαίνουν το ένα κάτω από το άλλο (όχι δίπλα-δίπλα) */
        .form-row {
            grid-template-columns: 1fr !important;
            gap: 15px;
        }

        /* 3. Μικραίνουμε τα περιθώρια (padding) */
        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 15px !important;
        }

        .modal {
            align-items: flex-end; /* Σε πολύ μικρά κινητά, ίσως βολεύει να ξεκινάει από κάτω, αλλά εδώ το κρατάμε κεντραρισμένο */
        }

        /* 4. Scroll μόνο στη μέση, τα κουμπιά μένουν σταθερά κάτω */
        .modal-body {
            max-height: calc(90vh - 130px); /* Ύψος οθόνης μείον header/footer */
            overflow-y: auto;
        }

        /* 5. Μεγαλύτερα κουμπιά για ευκολότερο πάτημα με το δάχτυλο */
        .btn-primary, .btn-outline {
            padding: 12px 20px;
            width: 100%; /* Τα κουμπιά πιάνουν όλο το πλάτος */
            justify-content: center;
            display: flex;
        }
        
        .modal-footer {
            flex-direction: column-reverse; /* Το Save πάει πάνω, το Cancel κάτω */
            gap: 10px;
        }
    }
</style>

</head>
<body class="bg-light-bg font-sans min-h-screen flex">

        <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
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

            <a href="calendar.php" id="nav-calendar" class="nav-link flex items-center p-3 rounded-xl bg-indigo-50 text-primary-blue font-medium mb-1">
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


    <!-- Main Content -->
    <div id="main-content" class="main-content">
        <!-- Header -->
        <header class="bg-card-bg p-4 sticky top-0 z-40 shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-2xl font-semibold text-text-primary">Calendar & Events</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button onclick="openModal()" class="nav-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Event
                    </button>
                </div>
            </div>
        </header>

        <!-- Events List -->
        <!-- Calendar Content -->
        <div class="content-area">
            <!-- Calendar Header -->
            <div class="calendar-header">
                <div class="calendar-title" id="calendarTitle">December 2025</div>
                <div class="calendar-nav">
                    <button class="nav-btn today-btn" onclick="goToToday()">
                        <i class="fa-solid fa-calendar-day"></i> Today
                    </button>
                    <button class="nav-btn" onclick="previousMonth()">
                        <i class="fa-solid fa-chevron-left"></i> Prev
                    </button>
                    <button class="nav-btn" onclick="nextMonth()">
                        Next <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="calendar-grid-container">
                <div class="calendar-weekdays">
                    <div class="weekday">Mon</div>
                    <div class="weekday">Tue</div>
                    <div class="weekday">Wed</div>
                    <div class="weekday">Thu</div>
                    <div class="weekday">Fri</div>
                    <div class="weekday">Sat</div>
                    <div class="weekday">Sun</div>
                </div>
                <div class="calendar-grid" id="calendarGrid">
                    <!-- Calendar days will be generated here -->
                </div>
            </div>
        </div>

    </div>

           <!-- Event Modal -->
    <div class="modal" id="eventModal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">×</span>
            <h2 class="modal-title" id="modalTitle">Add Event</h2>
            
            <form id="eventForm" onsubmit="return false;">
                <!-- Title -->
                <div class="form-group">
                    <label class="form-label">Title *</label>
                    <input type="text" class="form-input" id="inputTitle" placeholder="Event title" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-textarea" id="inputDescription" placeholder="Event description"></textarea>
                </div>

                <!-- Event Type & Priority -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Event Type *</label>
                        <select class="form-select" id="inputEventType">
                            <option value="task">Task</option>
                            <option value="meeting">Meeting</option>
                            <option value="reminder">Reminder</option>
                            <option value="deadline">Deadline</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Priority</label>
                        <select class="form-select" id="inputPriority">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>

                <!-- Start Date & End Date -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Start Date *</label>
                        <input type="date" class="form-input" id="inputStartDate" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-input" id="inputEndDate">
                    </div>
                </div>

                <!-- All Day Checkbox -->
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="inputAllDay" onchange="toggleTimeFields()">
                        <label for="inputAllDay" style="font-weight: normal; cursor: pointer;">All Day Event</label>
                    </div>
                </div>

                <!-- Start Time & End Time -->
                <div class="form-row" id="timeFields">
                    <div class="form-group">
                        <label class="form-label">Start Time</label>
                        <input type="time" class="form-input" id="inputStartTime">
                    </div>

                    <div class="form-group">
                        <label class="form-label">End Time</label>
                        <input type="time" class="form-input" id="inputEndTime">
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="inputStatus">
                        <option value="pending" selected>Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Assign To (Team Member) -->
                <div class="form-group">
                    <label class="form-label">Assign To</label>
                    <select class="form-select" id="inputAssignedTo">
                        <option value="">-- None --</option>
                        <!-- Team members will be loaded here -->
                    </select>
                </div>

                <!-- Link to Project -->
                <div class="form-group">
                    <label class="form-label">Link to Project</label>
                    <select class="form-select" id="inputProjectId">
                        <option value="">-- None --</option>
                        <!-- Projects will be loaded here -->
                    </select>
                </div>

                <!-- Actions -->
                <div class="modal-actions">
                    <button type="button" class="btn-outline" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-primary" onclick="saveEvent()">Save Event</button>
                </div>
            </form>
        </div>
    </div>


        <!-- Day Details Modal -->
    <div id="dayModal" class="modal">
        <div class="modal-content day-modal-content">
            <div class="modal-header">
                <div>
                    <h2 id="dayModalTitle">Events for December 17, 2025</h2>
                    <p id="dayModalSubtitle" style="color: #6b7280; font-size: 14px; margin-top: 5px;">3 events scheduled</p>
                </div>
                <button class="close-modal" onclick="closeDayModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div id="dayEventsContainer" class="day-events-grid">
                    <!-- Events will be inserted here by JavaScript -->
                </div>
                <div id="noEventsMessage" style="display: none; text-align: center; padding: 40px; color: #9ca3af;">
                    <i class="fas fa-calendar-day" style="font-size: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
                    <p>No events scheduled for this day</p>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Global Variables
        let events = [];
        let currentId = null;
        let currentDropdown = null;
        let teamMembers = [];
        let projects = [];
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();
        let selectedDate = null;

        const calendarGrid = document.getElementById('calendarGrid');
        const calendarTitle = document.getElementById('calendarTitle');
        const modal = document.getElementById('eventModal');
        const modalTitle = document.getElementById('modalTitle');

        // Form Inputs
        const titleInput = document.getElementById('inputTitle');
        const descInput = document.getElementById('inputDescription');
        const eventTypeInput = document.getElementById('inputEventType');
        const priorityInput = document.getElementById('inputPriority');
        const startDateInput = document.getElementById('inputStartDate');
        const endDateInput = document.getElementById('inputEndDate');
        const allDayInput = document.getElementById('inputAllDay');
        const startTimeInput = document.getElementById('inputStartTime');
        const endTimeInput = document.getElementById('inputEndTime');
        const statusInput = document.getElementById('inputStatus');
        const assignedToInput = document.getElementById('inputAssignedTo');
        const projectIdInput = document.getElementById('inputProjectId');

        // Month names
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                           'July', 'August', 'September', 'October', 'November', 'December'];

        // Load Events
        async function loadEvents() {
            try {
                const response = await fetch('calendar_handler.php?action=getEvents');
                const data = await response.json();
                events = data;
                renderCalendar();
            } catch (error) {
                console.error('Error loading events:', error);
                alert('Failed to load events!');
            }
        }

        // Render Calendar
        function renderCalendar() {
            calendarTitle.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            calendarGrid.innerHTML = '';

            // Get first day of month (0 = Sunday, 1 = Monday, etc.)
            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            
            // Adjust: Monday = 0, Sunday = 6
            let firstDayOfWeek = firstDay.getDay() - 1;
            if (firstDayOfWeek === -1) firstDayOfWeek = 6;

            const daysInMonth = lastDay.getDate();
            const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();

            // Previous month days
            for (let i = firstDayOfWeek - 1; i >= 0; i--) {
                const day = prevMonthDays - i;
                const dayElement = createDayElement(day, true, -1);
                calendarGrid.appendChild(dayElement);
            }

            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = createDayElement(day, false, 0);
                calendarGrid.appendChild(dayElement);
            }

            // Next month days
            const totalCells = calendarGrid.children.length;
            const remainingCells = 42 - totalCells; // 6 rows x 7 days
            for (let day = 1; day <= remainingCells; day++) {
                const dayElement = createDayElement(day, true, 1);
                calendarGrid.appendChild(dayElement);
            }
        }

        // Create Day Element
        function createDayElement(day, isOtherMonth, monthOffset) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            
            if (isOtherMonth) {
                dayElement.classList.add('other-month');
            }

            // Calculate actual date
            let month = currentMonth + monthOffset;
            let year = currentYear;
            if (month < 0) {
                month = 11;
                year--;
            } else if (month > 11) {
                month = 0;
                year++;
            }

            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            
            // Check if today
            const today = new Date();
            const isToday = day === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            if (isToday && !isOtherMonth) {
                dayElement.classList.add('today');
            }

            // Day number
            const dayNumber = document.createElement('div');
            dayNumber.className = 'day-number';
            dayNumber.textContent = day;
            dayElement.appendChild(dayNumber);

            // Get events for this day
            const dayEvents = events.filter(e => e.start_date === dateStr);
            
            if (dayEvents.length > 0 && !isOtherMonth) {
                dayElement.classList.add('has-events');
            }

            // Day events container
            const eventsContainer = document.createElement('div');
            eventsContainer.className = 'day-events';

            // Show max 2 events
            const maxVisible = 2;
            dayEvents.slice(0, maxVisible).forEach(event => {
                const eventDot = document.createElement('div');
                eventDot.className = `event-dot ${event.event_type}`;
                eventDot.textContent = event.title;
                eventDot.onclick = (e) => {
                    e.stopPropagation();
                    openModal(event);
                };
                eventsContainer.appendChild(eventDot);
            });

            // Show "more" indicator
            if (dayEvents.length > maxVisible) {
                const moreText = document.createElement('div');
                moreText.className = 'more-events';
                moreText.textContent = `+${dayEvents.length - maxVisible} more`;
                moreText.onclick = (e) => {
                    e.stopPropagation();
                    showDayEvents(dateStr, dayEvents);
                };
                eventsContainer.appendChild(moreText);
            }

            dayElement.appendChild(eventsContainer);

            // Click to add event
            dayElement.onclick = (e) => {
                if (!isOtherMonth) {
                    // Don't open modal if clicking on event dot or more text
                    if (e.target.classList.contains('event-dot') || 
                        e.target.classList.contains('more-events')) {
                        return;
                    }
                    // Open day modal to show all events
                    showDayEvents(dateStr, dayEvents);
                }
            };

            return dayElement;
        }

        // Show all events for a day (you can implement a side panel or modal)
        function showDayEvents(date, dayEvents) {
            const dateObj = new Date(date + 'T00:00:00');
            const formattedDate = dateObj.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });

            // Set modal title
            document.getElementById('dayModalTitle').textContent = formattedDate;
            document.getElementById('dayModalSubtitle').textContent = 
                dayEvents.length === 0 ? 'No events' : 
                dayEvents.length === 1 ? '1 event scheduled' : 
                `${dayEvents.length} events scheduled`;
            
            const container = document.getElementById('dayEventsContainer');
            const noEventsMsg = document.getElementById('noEventsMessage');
            
            container.innerHTML = '';
            
            if (dayEvents.length === 0) {
                container.style.display = 'none';
                noEventsMsg.style.display = 'block';
            } else {
                container.style.display = 'grid';
                noEventsMsg.style.display = 'none';
                
                dayEvents.forEach((event, index) => {
                    const eventCard = document.createElement('div');
                    eventCard.className = 'day-event-card';
                    eventCard.style.borderLeftColor = event.color || '#4c64ff';
                    
                    const time = event.all_day ? 'All Day' : 
                        (event.start_time ? event.start_time.substring(0, 5) : 'No time');
                    
                    eventCard.innerHTML = `
                        <div class="day-event-header">
                            <div class="day-event-time">
                                <i class="far fa-clock"></i>
                                ${time}
                            </div>
                            <div class="day-event-actions">
                                <button class="event-action-btn" onclick="editEventFromDay(${event.id})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="event-action-btn delete" onclick="deleteEventFromDay(${event.id})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="day-event-title">${event.title}</div>
                        ${event.description ? `<div class="day-event-description">${event.description}</div>` : ''}
                        <div class="day-event-meta">
                            <div class="day-event-meta-item">
                                <i class="fas fa-circle" style="color: ${event.color || '#4c64ff'}; font-size: 8px;"></i>
                                ${event.category || 'General'}
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(eventCard);
                });
            }
            
            // Open the modal
            document.getElementById('dayModal').style.display = 'flex';
        }


        // Navigation
        function previousMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        }

        function goToToday() {
            const today = new Date();
            currentMonth = today.getMonth();
            currentYear = today.getFullYear();
            renderCalendar();
        }

        // Open Modal
        function openModal(event = null) {
            modal.style.display = 'flex';
            
            if (event) {
                // EDIT MODE
                currentId = event.id;
                modalTitle.innerText = 'Edit Event';
                titleInput.value = event.title;
                descInput.value = event.description || '';
                eventTypeInput.value = event.event_type;
                priorityInput.value = event.priority;
                startDateInput.value = event.start_date;
                endDateInput.value = event.end_date || '';
                allDayInput.checked = event.all_day;
                startTimeInput.value = event.start_time || '';
                endTimeInput.value = event.end_time || '';
                statusInput.value = event.status;
                assignedToInput.value = event.assigned_to || '';
                projectIdInput.value = event.project_id || '';
                toggleTimeFields();
            } else {
                // ADD MODE
                currentId = null;
                modalTitle.innerText = 'Add Event';
                document.getElementById('eventForm').reset();
                if (selectedDate) {
                    startDateInput.value = selectedDate;
                }
                toggleTimeFields();
            }
        }


        // Close Modal
        function closeModal() {
            modal.style.display = 'none';
            document.getElementById('eventForm').reset();
            currentId = null;
            selectedDate = null;
        }


        function closeDayModal() {
            document.getElementById('dayModal').style.display = 'none';
        }

        // Close modal when clicking overlay
        const dayModal = document.getElementById('dayModal');
            dayModal.addEventListener('click', e => {
            if (e.target === dayModal) closeDayModal();
        });

        // Toggle Time Fields
        function toggleTimeFields() {
            const timeFields = document.getElementById('timeFields');
            const allDay = document.getElementById('inputAllDay').checked;
            
            if (allDay) {
                timeFields.style.display = 'none';
                document.getElementById('inputStartTime').value = '';
                document.getElementById('inputEndTime').value = '';
            } else {
                timeFields.style.display = 'grid';
            }
        }


        // Save Event
        async function saveEvent() {
            const title = titleInput.value.trim();
            const startDate = startDateInput.value;

            if (!title || !startDate) {
                return alert("Title and Start Date are required!");
            }

            const eventData = {
                id: currentId,
                title: title,
                description: descInput.value.trim(),
                event_type: eventTypeInput.value,
                start_date: startDate,
                end_date: endDateInput.value || null,
                start_time: allDayInput.checked ? null : (startTimeInput.value || null),
                end_time: allDayInput.checked ? null : (endTimeInput.value || null),
                all_day: allDayInput.checked ? 1 : 0,
                priority: priorityInput.value,
                status: statusInput.value,
                assigned_to: assignedToInput.value || null,
                project_id: projectIdInput.value || null
            };

            try {
                const response = await fetch('calendar_handler.php?action=saveEvent', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(eventData)
                });
                const result = await response.json();

                if (result.success) {
                    await loadEvents();
                    closeModal();
                } else {
                    alert('Failed to save event: ' + (result.error || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error saving event:', error);
                alert('Failed to save event!');
            }
        }

        // Delete Event (called from event dot right-click or dropdown)
        async function deleteEvent(eventId) {
            if (!confirm('Are you sure you want to delete this event?')) return;

            try {
                const response = await fetch('calendar_handler.php?action=deleteEvent', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({id: eventId})
                });
                const result = await response.json();

                if (result.success) {
                    await loadEvents();
                    closeModal();
                } else {
                    alert('Failed to delete event!');
                }
            } catch (error) {
                console.error('Error deleting event:', error);
                alert('Failed to delete event!');
            }
        }

        // Load Team Members & Projects
        async function loadTeamMembers() {
            try {
                const response = await fetch('team_handler.php?action=getMembers');
                const data = await response.json();
                teamMembers = data.filter(m => m.status === 'active');
                
                assignedToInput.innerHTML = '<option value="">-- None --</option>';
                teamMembers.forEach(member => {
                    const option = document.createElement('option');
                    option.value = member.id;
                    option.textContent = member.name;
                    assignedToInput.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading team members:', error);
            }
        }

        async function loadProjects() {
            try {
                const response = await fetch('project_handler.php?action=getProjects');
                const data = await response.json();
                projects = data;
                
                projectIdInput.innerHTML = '<option value="">-- None --</option>';
                projects.forEach(project => {
                    const option = document.createElement('option');
                    option.value = project.id;
                    option.textContent = project.name;
                    projectIdInput.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading projects:', error);
            }
        }

        // Auto-highlight active menu
        function setActiveMenu() {
            const currentPage = window.location.pathname.split('/').pop();
            
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('bg-indigo-50', 'text-primary-blue', 'font-medium');
                link.classList.add('text-text-secondary');
            });
            
            if (currentPage === 'calendar.php') {
                const calendarLink = document.getElementById('nav-calendar');
                if (calendarLink) {
                    calendarLink.classList.add('bg-indigo-50', 'text-primary-blue', 'font-medium');
                    calendarLink.classList.remove('text-text-secondary');
                }
            }
        }

        // Load on page load
        window.addEventListener('DOMContentLoaded', function() {
            loadEvents();
            loadTeamMembers();
            loadProjects();
            setActiveMenu();
        });
    </script>


</body>
</html>


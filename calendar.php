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
        
        /* Ίδιο φόντο με το container */
        background: var(--white); 
        
        /* Ίδιες γωνίες με το container (16px) */
        border-radius: 16px; 
        
        padding: 25px 35px;
        
        /* Ίδια σκιά ακριβώς με το calendar-grid-container */
        box-shadow: var(--shadow);
        
        /* Αφαιρούμε το περίγραμμα για να είναι ίδιο με το container */
        border: none; 
    }

    .calendar-title {
        font-size: 28px;
        font-weight: 700;
        /* Το βασικό χρώμα του Add Event (#4c64ff) */
        color: #4c64ff; 
        background: none;
        -webkit-background-clip: initial;
        -webkit-text-fill-color: initial;
        background-clip: border-box;
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
        /* Ανοιχτό/Βασικό χρώμα (#4c64ff) */
        background: #4c64ff; 
        color: var(--white);
        border: none;
        padding: 10px 24px;
        font-weight: 700;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .today-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s ease;
    }

    .today-btn:hover {
        background: #3d52cc; 
        transform: translateY(-3px) scale(1.05);
        /* Σκιά στο ίδιο χρώμα */
        box-shadow: 0 8px 20px rgba(76, 100, 255, 0.4); 
    }

    .today-btn:hover::before {
        left: 100%;
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
        /* Κλειδώνει όλα τα κελιά στο ίδιο ύψος */
        grid-auto-rows: 1fr; 
    }

    .calendar-day {
        /* ΣΤΑΘΕΡΗ ΔΟΜΗ ΓΙΑ ΟΛΑ */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 100%;
        min-height: 140px; 
        padding: 8px;
        
        background: #f8f9fa;
        border-radius: 12px;
        
        /* ΔΙΑΦΑΝΕΣ περίγραμμα 2px (πιάνει τον ίδιο χώρο με το Today) */
        border: 2px solid transparent; 
        
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .calendar-day:hover {
        border-color: #e2e8f0; /* Γκρι περίγραμμα στο hover των απλών */
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
    }

    .calendar-day.other-month {
        background: #fafafa;
        opacity: 0.4;
    }

    .calendar-day.today {
        background: #ffffff !important; 
        /* Το μπλε περίγραμμα αντικαθιστά το διαφανές (ίδιο πάχος) */
        border-color: #4c64ff !important; 
    }

    .calendar-day.today .day-number {
        color: #4c64ff !important; 
        /* font-size: 16px;  <-- ΚΛΗΡΟΝΟΜΕΙΤΑΙ (για να μην χαλάει η συμμετρία) */
        /* font-weight: 700; <-- ΚΛΗΡΟΝΟΜΕΙΤΑΙ */
    }

    .calendar-day.today:hover {
        border-color: #4c64ff !important;
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(76, 100, 255, 0.45);
        z-index: 10;
    }

    .calendar-day.has-events {
        border-left: 4px solid var(--primary-color);
    }

    .day-number {
        font-size: 16px;    /* Ίδιο μέγεθος παντού */
        font-weight: 700;   /* Ίδιο πάχος παντού */
        margin-bottom: 8px; /* Ίδιο κενό από τα events */
        color: var(--text-dark);
        flex-shrink: 0;
    }

    .day-events {
        display: flex;
        flex-direction: column;
        gap: 4px;
        width: 100%;
        flex: 1;
    }

    /* ========================================
       EVENT DOTS
       ======================================== */

    .event-dot {
        height: 24px; /* ΣΤΑΘΕΡΟ ΥΨΟΣ: Είτε 1 είτε 3, θα είναι ίδια */
        display: flex;
        align-items: center; /* ΚΕΝΤΡΑΡΙΣΜΑ ΚΕΙΜΕΝΟΥ ΚΑΘΕΤΑ */
        padding: 0 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: all 0.2s;
        width: 100%; /* Πιάνει όλο το πλάτος */
    }

    .event-dot:hover {
        opacity: 0.8;
        transform: translateY(-1px);
        z-index: 5;
    }

    .event-dot.task { background: var(--task-color); }
    .event-dot.meeting { background: var(--meeting-color); }
    .event-dot.reminder { background: var(--reminder-color); }
    .event-dot.deadline { background: var(--deadline-color); }

    .more-events {
        /* 1. ΙΔΙΕΣ ΔΙΑΣΤΑΣΕΙΣ ME TA EVENTS */
        height: 24px;       /* Ίδιο ύψος με το .event-dot */
        width: 100%;        /* Πιάνει όλο το πλάτος */
        border-radius: 6px; /* Ίδια στρογγυλάδα */
        padding: 0 8px;     /* Ίδιο padding */
        
        /* 2. ΚΕΝΤΡΑΡΙΣΜΑ & ΣΤΥΛ */
        display: flex;
        align-items: center;
        justify-content: center; /* Κεντράρισμα του κειμένου */
        
        font-size: 11px;
        font-weight: 700;
        margin-top: auto; /* Κολλάει στο κάτω μέρος αν υπάρχει κενό */
        
        /* 3. ΧΡΩΜΑΤΑ (Blue Theme) */
        color: #4c64ff; 
        background: rgba(76, 100, 255, 0.1); 
        
        cursor: pointer;
        transition: all 0.2s;
    }

    .more-events:hover {
        background: rgba(76, 100, 255, 0.2);
        transform: translateY(-1px);
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
       DAY MODAL SPECIFIC (Accordion List)
       ======================================== */
    .day-modal-content {
        max-width: 600px !important;
        width: 95%;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
    }
    
    .modal-body {
        padding: 20px;
        overflow-y: auto;
    }

    .day-events-grid {
        display: flex; 
        flex-direction: column;
        gap: 12px;
    }

    /* ΚΑΡΤΑ (Container) */
    .day-event-card {
        background: var(--white);
        border-radius: 12px;
        padding: 0; 
        border: 1px solid #e2e8f0;
        border-left: 4px solid #4c64ff;
        transition: all 0.2s ease;
        overflow: hidden; 
        cursor: pointer;
    }

    .day-event-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    /* HEADER (ΑΥΤΟ ΦΑΙΝΕΤΑΙ ΠΑΝΤΑ) */
    .day-event-header {
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
    }

    .day-event-time {
        font-size: 13px;
        font-weight: 700;
        padding: 6px 10px;
        border-radius: 6px;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 6px;
        flex-shrink: 0;
    }

    .day-event-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .chevron-icon {
        color: #94a3b8;
        transition: transform 0.3s ease;
    }

    .day-event-card.expanded .chevron-icon {
        transform: rotate(180deg);
        color: var(--primary-color);
    }

    /* DETAILS (ΑΥΤΑ ΕΙΝΑΙ ΚΡΥΦΑ - ΕΜΦΑΝΙΖΟΝΤΑΙ ΜΟΝΟ ΣΤΟ EXPANDED) */
    .day-event-details {
        max-height: 0;       /* Κλειστό ύψος */
        opacity: 0;          /* Αόρατο */
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        background: #f8fafc; 
        border-top: 1px solid #f1f5f9;
        padding: 0 20px;     /* Μηδέν padding όταν είναι κλειστό */
    }

    /* Όταν ανοίγει: */
    .day-event-card.expanded .day-event-details {
        max-height: 1000px;  /* Μεγάλο ύψος για να χωρέσουν όλα */
        opacity: 1;
        padding: 20px;       /* Επαναφορά padding */
    }

    /* Στυλ για τα περιεχόμενα (Περιγραφή, Grid, Κουμπιά) */
    .event-desc-text {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e2e8f0;
    }

    .details-label {
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 700;
        color: #94a3b8;
        margin-bottom: 10px;
        letter-spacing: 0.5px;
    }

    .event-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .info-item { display: flex; flex-direction: column; gap: 4px; }
    .info-label { font-size: 12px; font-weight: 600; color: #94a3b8; }
    .info-value { font-size: 14px; font-weight: 500; color: #1e293b; display: flex; align-items: center; gap: 8px; }
    .info-value i { font-size: 14px; color: #64748b; width: 16px; }

    .event-actions-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 10px;
        border-top: 1px solid #e2e8f0;
    }

    .action-btn-sm {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
        border: 1px solid transparent;
    }

    .btn-edit { background: #fff; border-color: #cbd5e1; color: #475569; }
    .btn-edit:hover { border-color: #4c64ff; color: #4c64ff; background: #eff6ff; }
    .btn-delete { background: #fff; border-color: #fca5a5; color: #ef4444; }
    .btn-delete:hover { background: #fef2f2; border-color: #ef4444; }

    #noEventsMessage { text-align: center; padding: 40px 20px; color: #94a3b8; }
    #noEventsMessage i { font-size: 48px; margin-bottom: 15px; opacity: 0.5; display: block; }

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
       MOBILE RESPONSIVE (Κινητά - 3 Στήλες)
       ======================================== */
    @media (max-width: 768px) {
        
        /* --- 1. Γενικές Ρυθμίσεις --- */
        body, html {
            overflow-x: hidden; /* Απαγορεύουμε το οριζόντιο κούνημα */
        }

        .main-content {
            width: 100vw;
        }

        .content-area {
            padding: 10px;
            padding-bottom: 80px; /* Χώρος κάτω για να μη κρύβεται τίποτα */
        }

       /* --- 2. Κεντρικό Header (Header όπως στο Project) --- */
        header .max-w-7xl {
            display: flex !important;
            flex-direction: row !important; /* Αυστηρά σε μία ευθεία */
            flex-wrap: nowrap !important;   /* Απαγορεύεται να κατέβει κάτω */
            align-items: center !important;
            justify-content: space-between !important;
            gap: 5px; 
            padding-right: 0; /* Κερδίζουμε λίγο χώρο δεξιά */
        }

        /* Τίτλος: Τον μικραίνουμε ελάχιστα για να χωράει */
        header h1.text-2xl {
            font-size: 18px !important;
            white-space: nowrap;      /* Όχι αλλαγή γραμμής */
            overflow: hidden;         /* Αν είναι τεράστιος, κόβεται */
            text-overflow: ellipsis;
            margin-right: auto;       /* Σπρώχνει τα δεξιά στοιχεία στην άκρη */
        }

        /* ΚΡΥΒΟΥΜΕ το μικρό εικονίδιο (φίλτρο) δίπλα στο κουμπί 
           για να αφήσουμε χώρο για το Μεγάλο Κουμπί */
        header .flex.items-center.space-x-4 > button:first-child {
            display: none !important;
        }

        /* Το κουμπί Add Event: Μεγάλο, Μπλε και Ολόκληρο */
        #new-event-button {
            display: flex !important;
            align-items: center;
            justify-content: center;
            
            /* Στυλ "Μεγάλου Κουμπιού" */
            width: auto !important;     /* Όχι όλο το πλάτος, όσο χρειάζεται */
            padding: 8px 16px !important; /* Άνετο padding */
            font-size: 14px !important;
            white-space: nowrap !important; /* Να φαίνεται όλο το κείμενο "Add Event" */
            
            /* Να μην ζουλιέται */
            flex-shrink: 0; 
            margin-left: 5px;
        }
        
        /* Κρύβουμε το εικονίδιο (+) μέσα στο κουμπί αν θέλουμε πιο καθαρό look, 
           αλλιώς το αφήνουμε. Εδώ το αφήνω για να μοιάζει με το Project. */
        #new-event-button svg {
            display: block; 
            margin-right: 5px;
        }
        
        /* Κρύβουμε το κείμενο "Add Event" και αφήνουμε μόνο το εικονίδιο αν δεν χωράει */
        #new-event-button {
            padding: 8px 12px;
            font-size: 13px;
            white-space: nowrap;
        }

        /* --- 3. Calendar Header (Μήνας & Κουμπιά) --- */
        .calendar-header {
            flex-direction: column; /* Κάθετη διάταξη */
            gap: 15px;
            padding: 15px 10px;
            align-items: center;
        }

        /* Ο Μήνας πάνω μόνος του */
        .calendar-title {
            font-size: 22px;
            text-align: center;
            width: 100%;
        }

        /* Τα κουμπιά σε ΜΙΑ ΕΥΘΕΙΑ από κάτω */
        .calendar-nav {
            display: flex;
            width: 100%;
            justify-content: space-between; /* Άκρη-άκρη */
            gap: 10px;
        }

        .nav-btn {
            flex: 1; /* Να πιάνουν ίσο χώρο */
            justify-content: center;
            padding: 10px 5px;
            font-size: 13px;
        }

        /* --- 4. Πλέγμα Ημερολογίου (3 Στήλες) --- */
        .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        
        /* ΤΟ ΜΥΣΤΙΚΟ: Κάνει όλες τις γραμμές να έχουν ΑΚΡΙΒΩΣ το ίδιο ύψος */
        grid-auto-rows: 1fr; 
        
        /* Αφαιρούμε το min-height: 600px για να το αφήσουμε να προσαρμόζεται στο περιεχόμενο */
        min-height: auto; 
       }

        /* ΚΡΥΒΟΥΜΕ τις μέρες της εβδομάδας (Mon, Tue...) γιατί δεν ταιριάζουν με 3 στήλες */
        .calendar-weekdays {
            display: none;
        }

        .calendar-grid {
            display: grid;
            /* ΤΟ ΖΗΤΟΥΜΕΝΟ: 3 Στήλες */
            grid-template-columns: repeat(3, 1fr) !important; 
            gap: 8px;
            min-height: auto;
            min-width: unset; /* Αφαιρούμε το πλάτος για να χωράει στην οθόνη */
        }

        .calendar-day {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 8px;
            
            /* Σημαντικό: Να πιάνει όλο το ύψος του κελιού του grid */
            height: 100%; 
            
            /* Ελάχιστο ύψος για να χωράνε άνετα 3 events (όπως το Today) */
            min-height: 140px; 
            
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            
            /* Διαφανές περίγραμμα 2px για να πιάνει τον ίδιο χώρο με το Today */
            border: 2px solid transparent; 
            
            /* Flexbox για να στοιχίζονται όλα ίδια */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .day-number {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            flex-shrink: 0; /* Δεν ζουλιέται ποτέ */
        }

        /* Μικραίνουμε τα events για να χωράνε */
        .event-dot {
            font-size: 10px;
            padding: 3px 6px;
            margin-bottom: 2px;
        }

        /* --- 5. Modal Styles (Αμετάβλητα για σωστή λειτουργία) --- */
        .modal-content {
            width: 95% !important;
            max-width: 95% !important;
            max-height: 90vh !important;
            margin: auto;
        }

        .form-row {
            grid-template-columns: 1fr !important;
            gap: 15px;
        }

        .modal-header, .modal-body, .modal-footer {
            padding: 15px !important;
        }
        
        .modal-body {
            max-height: calc(90vh - 130px);
            overflow-y: auto;
        }

        .modal-footer {
            flex-direction: column-reverse;
            gap: 10px;
        }
        
        .btn-primary, .btn-outline {
            width: 100%;
            justify-content: center;
            display: flex;
        }
    }
</style>

</head>
<body class="bg-light-bg font-sans min-h-screen flex">

        <!-- Sidebar -->
    <div id="sidebar" class="sidebar fixed inset-y-0 left-0 w-64 bg-sidebar-bg p-4 flex flex-col border-r border-gray-100 lg:relative lg:translate-x-0 transform -translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
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
    <div id="main-content" class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-card-bg p-4 sticky top-0 z-40 shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <button id="menu-button" class="lg:hidden p-2 rounded-md text-text-primary mr-3 hover:bg-light-bg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-2xl font-semibold text-text-primary">Calendar & Events</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button class="p-2 rounded-full text-text-secondary hover:bg-light-bg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                    
                    <button id="new-event-button" class="flex items-center bg-primary-blue text-white py-2 px-4 rounded-xl font-medium shadow-md hover:bg-indigo-700 transition duration-150" onclick="openModal()">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
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
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Add Event</h2>
                <button class="close-modal" onclick="closeModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="eventForm" onsubmit="return false;">
                    <div class="form-group">
                        <label class="form-label">Title *</label>
                        <input type="text" class="form-input" id="inputTitle" placeholder="Event title" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-textarea" id="inputDescription" placeholder="Event description"></textarea>
                    </div>

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

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="inputAllDay" onchange="toggleTimeFields()">
                            <label for="inputAllDay" style="font-weight: normal; cursor: pointer;">All Day Event</label>
                        </div>
                    </div>

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

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="inputStatus">
                            <option value="pending" selected>Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Assign To</label>
                        <select class="form-select" id="inputAssignedTo">
                            <option value="">-- None --</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Link to Project</label>
                        <select class="form-select" id="inputProjectId">
                            <option value="">-- None --</option>
                            </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal()">Cancel</button>
                <button type="button" class="btn-primary" onclick="saveEvent()">Save Event</button>
            </div>
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
        // 1. ΟΡΙΣΜΟΣ ΧΡΩΜΑΤΩΝ ΒΑΣΕΙ PRIORITY (Το βάζουμε στην αρχή για να το βρίσκει πάντα)
        const priorityColors = {
            'low': '#0097a7',      // Cyan (Ίδιο με το "Active" του Project)
            'medium': '#f59e0b',   // Orange (Ίδιο με το "Planning" του Project)
            'high': '#ef4444'      // Red (Ίδιο με το "Delete/Inactive" για επείγοντα)
        };

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

        // --- SIDEBAR TOGGLE LOGIC ---
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');

        if (menuButton) {
            menuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        document.addEventListener('click', (e) => {
            if (!sidebar.classList.contains('-translate-x-full') && 
                !sidebar.contains(e.target) && 
                window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Load Events
        async function loadEvents() {
            try {
                const response = await fetch('calendar_handler.php?action=getEvents');
                const data = await response.json();
                events = data;
                renderCalendar();
            } catch (error) {
                console.error('Error loading events:', error);
                // Δεν βγάζουμε alert για να μην ενοχλεί αν είναι προσωρινό το θέμα
            }
        }

        // Render Calendar
        function renderCalendar() {
            calendarTitle.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            calendarGrid.innerHTML = '';

            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            
            let firstDayOfWeek = firstDay.getDay() - 1;
            if (firstDayOfWeek === -1) firstDayOfWeek = 6;

            const daysInMonth = lastDay.getDate();
            const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();

            for (let i = firstDayOfWeek - 1; i >= 0; i--) {
                const day = prevMonthDays - i;
                const dayElement = createDayElement(day, true, -1);
                calendarGrid.appendChild(dayElement);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = createDayElement(day, false, 0);
                calendarGrid.appendChild(dayElement);
            }

            const totalCells = calendarGrid.children.length;
            const remainingCells = 42 - totalCells;
            for (let day = 1; day <= remainingCells; day++) {
                const dayElement = createDayElement(day, true, 1);
                calendarGrid.appendChild(dayElement);
            }
        }

      
        
        // Create Day Element (Fixed & Symmetrical)
        function createDayElement(day, isOtherMonth, monthOffset) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            
            if (isOtherMonth) {
                dayElement.classList.add('other-month');
            }

            let month = currentMonth + monthOffset;
            let year = currentYear;
            if (month < 0) { month = 11; year--; } 
            else if (month > 11) { month = 0; year++; }

            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            
            const today = new Date();
            const isToday = day === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            if (isToday && !isOtherMonth) dayElement.classList.add('today');

            const dayNumber = document.createElement('div');
            dayNumber.className = 'day-number';
            dayNumber.textContent = day;
            dayElement.appendChild(dayNumber);

            const dayEvents = events.filter(e => e.start_date === dateStr);
            
            if (dayEvents.length > 0 && !isOtherMonth) dayElement.classList.add('has-events');

            const eventsContainer = document.createElement('div');
            eventsContainer.className = 'day-events';

            // ΛΟΓΙΚΗ ΓΙΑ 3 EVENTS:
            // Αν έχουμε μέχρι 3 events, τα δείχνουμε όλα (χωράνε ακριβώς).
            // Αν έχουμε 4+, δείχνουμε τα 2 και το κουμπί "More".
            let limit = 3;
            if (dayEvents.length > 3) {
                limit = 2;
            }

            dayEvents.slice(0, limit).forEach(event => {
                const eventDot = document.createElement('div');
                eventDot.className = 'event-dot';
                eventDot.textContent = event.title;
                
                // Χρώματα Project Style
                const prio = event.priority ? event.priority.toLowerCase() : 'medium';
                const color = priorityColors[prio] || '#0097a7'; 
                
                eventDot.style.color = color;
                eventDot.style.backgroundColor = color + '25'; 
                
                eventsContainer.appendChild(eventDot);
            });

            // Αν κόψαμε events, δείχνουμε το κουμπί
            if (dayEvents.length > limit) {
                const moreText = document.createElement('div');
                moreText.className = 'more-events';
                moreText.textContent = `+${dayEvents.length - limit} more`;
                eventsContainer.appendChild(moreText);
            }

            dayElement.appendChild(eventsContainer);

            dayElement.onclick = (e) => {
                if (!isOtherMonth) {
                    showDayEvents(dateStr, dayEvents);
                }
            };

            return dayElement;
        }

        // Show Day Details (Full Info Hidden in Accordion)
        function showDayEvents(date, dayEvents) {
            const dateObj = new Date(date + 'T00:00:00');
            const formattedDate = dateObj.toLocaleDateString('en-US', { 
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' 
            });

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
                container.style.display = 'flex'; 
                noEventsMsg.style.display = 'none';
                
                dayEvents.forEach((event) => {
                    // --- Ετοιμασία Δεδομένων ---
                    const prio = event.priority ? event.priority.toLowerCase() : 'medium';
                    const color = priorityColors[prio] || '#4c64ff';
                    const priorityDisplay = prio.charAt(0).toUpperCase() + prio.slice(1);
                    const typeDisplay = event.event_type.charAt(0).toUpperCase() + event.event_type.slice(1);
                    const statusDisplay = event.status.charAt(0).toUpperCase() + event.status.slice(1);
                    
                    const timeHeader = event.all_day == 1 ? 'All Day' : 
                        (event.start_time ? event.start_time.substring(0, 5) : 'No time');

                    // Ανάκτηση ονομάτων από ID
                    let projectName = 'No Project';
                    if (event.project_id) {
                        const proj = projects.find(p => p.id == event.project_id);
                        if (proj) projectName = proj.name;
                    }

                    let memberName = 'Unassigned';
                    if (event.assigned_to) {
                        const mem = teamMembers.find(m => m.id == event.assigned_to);
                        if (mem) memberName = mem.name;
                    }

                    const eventCard = document.createElement('div');
                    eventCard.className = 'day-event-card';
                    eventCard.style.borderLeftColor = color;
                    eventCard.onclick = function() { toggleEventCard(this); };

                    eventCard.innerHTML = `
                        <div class="day-event-header">
                            <div class="header-left">
                                <div class="day-event-time" style="color: ${color}; background: ${color}15;">
                                    <i class="far fa-clock"></i> ${timeHeader}
                                </div>
                                <h3 class="day-event-title">${event.title}</h3>
                            </div>
                            <i class="fas fa-chevron-down chevron-icon"></i>
                        </div>

                        <div class="day-event-details">
                            
                            <div class="details-label">Description</div>
                            <div class="event-desc-text">
                                ${event.description ? event.description : '<span style="color:#94a3b8; font-style:italic;">No description provided.</span>'}
                            </div>
                            
                            <div class="details-label">Event Information</div>
                            <div class="event-info-grid">
                                <div class="info-item">
                                    <span class="info-label">Status</span>
                                    <span class="info-value"><i class="fas fa-tasks"></i> ${statusDisplay}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Priority</span>
                                    <span class="info-value" style="color: ${color};"><i class="fas fa-flag"></i> ${priorityDisplay}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Type</span>
                                    <span class="info-value"><i class="fas fa-tag"></i> ${typeDisplay}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Assigned To</span>
                                    <span class="info-value"><i class="fas fa-user"></i> ${memberName}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Project</span>
                                    <span class="info-value"><i class="fas fa-briefcase"></i> ${projectName}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Timeline</span>
                                    <span class="info-value"><i class="far fa-calendar-alt"></i> ${event.start_date}</span>
                                </div>
                            </div>

                            <div class="event-actions-footer">
                                <button class="action-btn-sm btn-edit" onclick="event.stopPropagation(); editEventFromDay(${event.id})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="action-btn-sm btn-delete" onclick="event.stopPropagation(); deleteEventFromDay(${event.id})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    `;
                    container.appendChild(eventCard);
                });
            }
            document.getElementById('dayModal').style.display = 'flex';
        }
        
        // Μην ξεχάσεις αυτή τη μικρή συνάρτηση για το κλικ
        function toggleEventCard(card) {
            // Αν θέλεις να κλείνουν τα άλλα όταν ανοίγει ένα καινούργιο, βγάλε τα σχόλια από κάτω:
            // document.querySelectorAll('.day-event-card.expanded').forEach(c => { if(c !== card) c.classList.remove('expanded'); });
            
            card.classList.toggle('expanded');
        }

        // Functions for Edit/Delete from Day Modal
        function editEventFromDay(id) {
            const event = events.find(e => e.id == id);
            if (event) {
                closeDayModal();
                openModal(event);
            }
        }

        function deleteEventFromDay(id) {
            // Η επιβεβαίωση γίνεται μέσα στην deleteEvent
            deleteEvent(id).then((success) => {
                if(success) closeDayModal();
            });
        }

        function closeDayModal() {
            document.getElementById('dayModal').style.display = 'none';
        }
        
        const dayModal = document.getElementById('dayModal');
        dayModal.addEventListener('click', e => {
            if (e.target === dayModal) closeDayModal();
        });

        // Navigation
        function previousMonth() {
            currentMonth--;
            if (currentMonth < 0) { currentMonth = 11; currentYear--; }
            renderCalendar();
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) { currentMonth = 0; currentYear++; }
            renderCalendar();
        }

        function goToToday() {
            const today = new Date();
            currentMonth = today.getMonth();
            currentYear = today.getFullYear();
            renderCalendar();
        }

        // Open Modal (Add/Edit)
        function openModal(event = null) {
            modal.style.display = 'flex';
            
            if (event) {
                currentId = event.id;
                modalTitle.innerText = 'Edit Event';
                titleInput.value = event.title;
                descInput.value = event.description || '';
                eventTypeInput.value = event.event_type;
                priorityInput.value = event.priority;
                startDateInput.value = event.start_date;
                endDateInput.value = event.end_date || '';
                allDayInput.checked = event.all_day == 1;
                startTimeInput.value = event.start_time || '';
                endTimeInput.value = event.end_time || '';
                statusInput.value = event.status;
                assignedToInput.value = event.assigned_to || '';
                projectIdInput.value = event.project_id || '';
                toggleTimeFields();
            } else {
                currentId = null;
                modalTitle.innerText = 'Add Event';
                document.getElementById('eventForm').reset();
                if (selectedDate) startDateInput.value = selectedDate;
                toggleTimeFields();
            }
        }

        function closeModal() {
            modal.style.display = 'none';
            document.getElementById('eventForm').reset();
            currentId = null;
            selectedDate = null;
        }

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

        // Delete Event
        async function deleteEvent(eventId) {
            if (!confirm('Are you sure you want to delete this event?')) return false;

            try {
                const response = await fetch('calendar_handler.php?action=deleteEvent', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({id: eventId})
                });
                const result = await response.json();

                if (result.success) {
                    await loadEvents();
                    closeModal(); // Κλείνει το Edit Modal αν είναι ανοιχτό
                    return true;
                } else {
                    alert('Failed to delete event!');
                    return false;
                }
            } catch (error) {
                console.error('Error deleting event:', error);
                alert('Failed to delete event!');
                return false;
            }
        }

        // Load Team & Projects
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
            } catch (error) { console.error('Error loading team members:', error); }
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
            } catch (error) { console.error('Error loading projects:', error); }
        }

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

        // Initial Load
        window.addEventListener('DOMContentLoaded', function() {
            loadEvents();
            loadTeamMembers();
            loadProjects();
            setActiveMenu();
        });
    </script>


</body>
</html>


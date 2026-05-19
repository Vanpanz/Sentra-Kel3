# 🏗️ SENTRA Architecture & Design Patterns

## Overview
SENTRA menggunakan **MVC Architecture** dengan pola dari **Sistem Sekolah** sebagai referensi. Fokus pada scalability, security, dan maintainability.

---

## 🎯 Design Principles

### 1. Separation of Concerns
```
Model   → Data & Business Logic (Database operations)
View    → Presentation Layer (HTML & CSS)
Control → Request Handler (Business flow)
```

### 2. DRY (Don't Repeat Yourself)
- Base Controller class untuk shared methods
- Reusable view components (partials)
- Database query abstraction

### 3. Security First
- Prepared statements untuk SQL injection prevention
- Password hashing dengan password_hash()
- XSS protection dengan htmlspecialchars()
- CSRF awareness (ready for implementation)

### 4. Type Hints & Validation
```php
public function insert(array $data): array
public function updateStatus(int $id, string $status): array
```

---

## 📊 Architecture Flow

```
┌─────────────────────────────────────────────────────┐
│                   Browser Request                   │
└──────────────────┬──────────────────────────────────┘
                   │
┌──────────────────▼──────────────────────────────────┐
│           public/index.php (Router)                 │
│     Parse URL & Match Routes                        │
└──────────────────┬──────────────────────────────────┘
                   │
┌──────────────────▼──────────────────────────────────┐
│      app/controllers/EventController.php             │
│     Request Handler & Flow Logic                    │
└──────────────────┬──────────────────────────────────┘
                   │
      ┌────────────┴────────────┐
      │                         │
┌─────▼─────────────────┐   ┌──▼──────────────────────┐
│  app/models/*          │   │  app/views/*            │
│  - Event.php           │   │  - index.php            │
│  - User.php            │   │  - detail.php           │
│  - EventRegistration   │   │  - layouts/app.php      │
│  (Query Builder)       │   │  (Template Rendering)   │
└─────┬─────────────────┘   └──┬──────────────────────┘
      │                         │
      └────────────┬────────────┘
                   │
┌──────────────────▼──────────────────────────────────┐
│      app/core/Database.php                          │
│      MySQLi Connection Pool                         │
└──────────────────┬──────────────────────────────────┘
                   │
┌──────────────────▼──────────────────────────────────┐
│           MySQL Database                            │
│  users | events | event_registrations | ...         │
└─────────────────────────────────────────────────────┘
```

---

## 🔌 Core Components

### 1. Database Class
**Location:** `app/core/Database.php`  
**Purpose:** Centralized MySQL connection management

```php
class Database {
    protected $connection;
    
    public function __construct() {
        $this->connection = mysqli_connect(...);
    }
}
```

**Benefits:**
- Single source of truth for DB connection
- Easy to extend with connection pooling
- Consistent error handling

### 2. Base Controller
**Location:** `app/core/Controller.php`  
**Purpose:** Shared controller functionality

```php
class Controller {
    public function view(string $view, array $data = []) {
        extract($data);
        require_once "../app/views/layouts/app.php";
    }
}
```

**Features:**
- Automatic view loading
- Data passing via extract()
- Layout wrapping

### 3. Router
**Location:** `app/core/Router.php`  
**Purpose:** URL routing & request dispatching

```php
$router->add('GET', '/events/{id}', 'EventController', 'show');
```

**Features:**
- Semantic URL routing
- Parameter extraction
- Dynamic controller loading
- HTTP method support

---

## 📋 Model Layer

### Event Model
```php
class Event extends Database {
    protected $table = 'events';
    
    // Get Methods
    - getEvents(?status)           // List with filter
    - getEvent(id)                 // Single by ID
    - getEventsByOrganizer(userId) // User's events
    - getEventsWithCount()         // With participant count
    - getOngoingEvents()           // Active events
    - getCompletedEvents()         // Finished events
    
    // CRUD Methods
    - insert(array)     // Add new
    - update(array, id) // Modify
    - delete(id)        // Remove
    - updateStatus()    // Change status
    
    // Utility Methods
    - isEventFull(id)              // Check quota
    - getRegistrationCount(id)     // Participant count
    - search(keyword)              // Full-text search
}
```

### EventRegistration Model
```php
class EventRegistration extends Database {
    protected $table = 'event_registrations';
    
    // Get Methods
    - getRegistrations()
    - getRegistration(id)
    - getRegistrationsByEvent(id, ?status)
    - getRegistrationsByUser(userId)
    - isUserRegistered(eventId, userId)
    - getUserParticipationHistory(userId)
    
    // CRUD Methods
    - insert(array)
    - update(array, id)
    - delete(id)
    
    // Status Management
    - updateStatus(id, status)
    - updateAttendance(id, status)
    
    // Statistics
    - getEventStatistics(eventId)
    - getParticipationStatistics()
}
```

### User Model
```php
class User extends Database {
    protected $table = 'users';
    
    // Get Methods
    - getUsers(?role)         // All or by role
    - getUser(id)            // Single user
    - getUserByEmail(email)  // Find by email
    - getStudents()          // All students
    - getTeachers()          // All teachers
    
    // User Management
    - register(array)        // New account
    - update(array, id)      // Edit profile
    - updatePassword()       // Change password
    - delete(id)             // Soft delete
    - hardDelete(id)         // Permanent delete
    
    // Authentication
    - login(email, password) // Auth check
    
    // Utility
    - search(keyword)        // Find users
    - getRoleStatistics()    // Count by role
}
```

---

## 🎮 Controller Actions

### EventController Methods
```php
// Public Pages
- index()              // List events
- show(id)            // Event details
- about()             // About page
- profile()           // User profile
- search()            // Search results

// Authentication
- login()             // Login form
- loginProcess()      // Process login
- register_page()     // Register form
- registerProcess()   // Process register
- logout()            // Logout

// Event Management (CRUD)
- create()            // Create form
- store()             // Save new
- edit(id)            // Edit form
- update(id)          // Save changes
- destroy(id)         // Delete

// Registration
- register()          // Register user
- cancelRegistration()// Cancel reg
- registrations(id)   // Admin list
- updateRegistration()// Admin update
```

---

## 🖼️ View Structure

### Layered Views
```
layouts/app.php (Master template)
├── partials/header.php     (Navigation)
├── [content]               (Rendered view)
└── partials/footer.php     (Info)
```

### View Organization
```
events/
├── index.php      (List with grid)
├── detail.php     (Full info + register)
├── create.php     (Form for new)
├── edit.php       (Form for edit)
└── search.php     (Results)

auth/
├── login.php      (Login form)
└── register.php   (Registration form)

pages/
├── about.php      (About info)
└── profile.php    (User profile)

registrations/
└── index.php      (Admin participant list)

layouts/
├── app.php        (Master template)
└── partials/
    ├── header.php (Navigation + user menu)
    └── footer.php (Footer info)
```

---

## 🔐 Security Implementation

### Input Protection
```php
// XSS Prevention
$title = htmlspecialchars($data['title']);

// SQL Injection Prevention
$stmt = $connection->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Type Validation
intval($data['quota']);
```

### Password Security
```php
// Registration
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Login
password_verify($inputPassword, $user['password']);
```

### Data Integrity
```sql
-- Foreign Keys
ALTER TABLE event_registrations 
ADD FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE;

-- Unique Constraints
ALTER TABLE users ADD UNIQUE KEY (email);
ALTER TABLE event_registrations ADD UNIQUE KEY (event_id, user_id);
```

---

## 📊 Database Schema

### Relationships
```
users (1) ──────────── (N) events
         organizer_id  ↓ user_id
                     event_registrations
                           ↑
                     └─────── event_id

users (1) ──────────── (N) event_registrations
         user_id
```

### Key Tables
```
users
├── id (PK)
├── name
├── email (UNIQUE)
├── password (hashed)
├── role (enum: student, teacher, admin)
└── created_at, updated_at

events
├── id (PK)
├── title
├── description
├── organizer_id (FK → users)
├── event_date
├── quota
├── status (enum: draft, published, ongoing, completed, cancelled)
└── created_at, updated_at

event_registrations
├── id (PK)
├── event_id (FK → events)
├── user_id (FK → users)
├── registration_status (enum: pending, confirmed, rejected, cancelled)
├── attendance_status (enum: present, absent, not-taken)
├── registered_at
└── UNIQUE(event_id, user_id)
```

---

## 🎨 Frontend Architecture

### Tailwind CSS Structure
```css
/* Global Styles */
.card        → White box with shadow
.btn         → Button with hover effects
.form-group  → Input container
.alert       → Alert messages

/* Responsive */
.grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3
.flex flex-col md:flex-row
.hidden md:flex
```

### Component Hierarchy
```
<header>
  Logo + Navigation + User Menu
  Mobile Toggle
</header>

<main>
  Flash Messages
  Page Content
</main>

<footer>
  Info + Links + Contact
</footer>
```

---

## 🔄 Request Flow Example

### Registering to Event
```
1. User clicks "Daftar Event" button
   ↓
2. POST /event/{id}/register
   ↓
3. EventController::register()
   - Check session
   - Validate event
   - Check quota
   ↓
4. EventRegistration::insert()
   - Check duplicate
   - Insert record
   ↓
5. JSON Response
   {"success": true, "message": "Berhasil mendaftar"}
   ↓
6. JavaScript reloads page
```

---

## 🚀 Performance Considerations

### Database Optimization
- ✅ Indexes on foreign keys
- ✅ Prepared statements (prevent full table scans)
- ✅ Selective column queries (not SELECT *)
- 🔄 Connection pooling (future)
- 🔄 Query caching (future)

### Frontend Optimization
- ✅ Minified CSS (Tailwind)
- ✅ Lazy image loading (planned)
- 🔄 Asset versioning (future)
- 🔄 API endpoints (future)

---

## 📈 Scalability Path

### Phase 1 (Current) ✅
- Single database connection
- Session-based authentication
- File uploads to local storage

### Phase 2 (Next)
- [ ] API endpoints for mobile
- [ ] JWT authentication
- [ ] Cloud storage integration
- [ ] Redis caching

### Phase 3 (Future)
- [ ] Microservices architecture
- [ ] Message queue system
- [ ] Full-text search engine
- [ ] CDN integration

---

## 🧪 Testing Strategy

### Unit Tests (Planned)
```php
// Models
test_EventModel::testGetEvent()
test_UserModel::testLogin()

// Controllers
test_EventController::testShow()
```

### Integration Tests (Planned)
```
Test complete registration flow
Test event CRUD operations
Test authentication system
```

### Manual Testing (Ready)
- Browser testing (Chrome, Firefox, Safari)
- Mobile testing (iPhone, Android)
- API testing (Postman)

---

## 📖 Coding Standards

### Naming Conventions
```
Classes:        EventController, EventRegistration
Methods:        getEvents(), updateStatus()
Variables:      $eventId, $registrationStatus
Database:       users, event_registrations (snake_case)
Constants:      DB_HOST, DB_NAME (UPPER_SNAKE_CASE)
```

### Code Organization
```
1. Class declaration & properties
2. Constructor
3. Public methods (Get, Create, Update, Delete)
4. Private methods (Helpers)
5. Comments on complex logic
```

### Documentation
```php
/**
 * Get all events
 * @param string $status Filter by status
 * @return array List of events
 */
public function getEvents(string $status = null): array
```

---

## 🔗 Related Documentation

- Database: `sentra_improved_database.sql`
- Implementation: `IMPLEMENTATION_GUIDE.md`
- Checklist: `CHECKLIST_IMPLEMENTASI.md`

---

**Generated:** 19 Mei 2026  
**Version:** 2.0  
**Status:** ✅ Documentation Complete

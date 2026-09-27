# Manufacturing Operations Platform

### Modular operations platform for industrial environments

> A software platform designed to connect inventory, production, traceability and operational workflows in manufacturing environments — replacing fragmented spreadsheets, manual processes and disconnected tools with a structured operational system.

[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square\&logo=laravel\&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=flat-square\&logo=php\&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?style=flat-square\&logo=mysql\&logoColor=white)](https://www.mysql.com/)
[![Docker](https://img.shields.io/badge/Docker-Local%20Development-2496ED?style=flat-square\&logo=docker\&logoColor=white)](https://www.docker.com/)
[![Blade](https://img.shields.io/badge/Blade-Laravel-FF2D20?style=flat-square\&logo=laravel\&logoColor=white)](https://laravel.com/)
[![Status](https://img.shields.io/badge/Status-In%20Development-111111?style=flat-square)](#current-status)

---

<!--
DEMO VISUAL

Recommended asset:
docs/demo/manufacturing-platform-demo.gif

Recommended recording:
10–15 seconds

Suggested sequence:
1. Dashboard
2. Inventory
3. Open a material / product
4. Show stock movements / traceability
5. Open a production order
6. Return to dashboard

Use real data from the demo environment.
Avoid mockup images.
-->

<p align="center">
  <img
    src="docs/demo/manufacturing-platform-demo.gif"
    alt="Manufacturing Operations Platform visual demo"
    width="100%"
  >
</p>

<p align="center">
  <sub>Visual demo — operational dashboard, inventory, traceability and production workflows.</sub>
</p>

---

<!-- SCREENSHOT #1 — DASHBOARD
Recommended:
docs/screenshots/dashboard.webp
-->

![Manufacturing Operations Platform Dashboard](docs/screenshots/dashboard.webp)

---

# The problem

Manufacturing environments rarely suffer from a lack of data.

They suffer from **fragmented data and disconnected processes**.

Information can be distributed across:

```text
ERP
Excel
Email
PDF documents
Production notes
Warehouse records
Manual calculations
CAD data
Internal applications
```

This makes seemingly simple questions unnecessarily difficult:

> Do we have enough material for this production order?

> Where is this material currently located?

> Has it already been reserved?

> When was this stock received?

> Which production order consumed it?

> Who changed its status?

> What happened to this component?

The problem is not simply storing information.

The problem is **connecting operational information into a coherent workflow**.

---

# The idea

Manufacturing Operations Platform is a modular software platform designed around the operational reality of industrial companies.

Instead of trying to replace an entire ERP, the platform focuses on the layer where day-to-day operational processes become fragmented.

```text
                    ┌───────────────────────┐
                    │  Manufacturing Core   │
                    └───────────┬───────────┘
                                │
        ┌───────────────┬───────┼────────┬───────────────┐
        │               │       │        │               │
        ▼               ▼       ▼        ▼               ▼
    Inventory      Production  Quality  Logistics   Maintenance
        │               │       │        │               │
        └───────────────┴───────┼────────┴───────────────┘
                                │
                                ▼
                         Traceability
                                │
                                ▼
                         Audit / Events
```

The core remains shared.

Business-specific capabilities can be introduced as independent modules.

---

# A platform, not another ERP clone

The objective is not to recreate every feature of a traditional ERP.

Instead, the platform provides a common operational foundation:

```text
Users
Roles
Permissions
Inventory
Locations
Materials
Products
Workflows
Traceability
Reservations
Audit
Events
```

Additional business modules can then build on top of that foundation.

For example:

```text
Manufacturing
    ↓
Production Orders
    ↓
Material Requirements
    ↓
Reservations
    ↓
Consumption
    ↓
Traceability
```

Or:

```text
Quality
    ↓
Inspection
    ↓
Incident
    ↓
Non-conformity
    ↓
Resolution
    ↓
Audit trail
```

This modular approach allows the same core platform to support different industrial workflows.

---

# Core concept

The most important concept is not the dashboard.

It is the **operational flow**.

For example, a material can move through several states:

```text
RECEIVED
   ↓
AVAILABLE
   ↓
RESERVED
   ↓
IN PRODUCTION
   ↓
CONSUMED
```

At every step, the system should be able to answer:

```text
What happened?
When did it happen?
Why did it happen?
Who performed it?
Which order caused it?
Which material was affected?
What was its previous state?
```

This creates an auditable operational history instead of simply overwriting database values.

---

# Inventory

Inventory is treated as a transversal capability rather than the entire product.

The system is designed around concepts such as:

* materials
* products
* stock quantities
* locations
* stock states
* reservations
* movements
* receipts
* consumption
* adjustments
* traceability

A stock quantity is therefore more than a number.

Conceptually:

```text
Material
    +
Location
    +
State
    +
Quantity
    +
Traceability
    +
Movement history
```

This provides the foundation required by production, logistics and other modules.

---

<!-- SCREENSHOT #2 — INVENTORY
Recommended:
docs/screenshots/inventory.webp
-->

![Inventory](docs/screenshots/inventory.webp)

---

# Production

Production is built around real operational relationships rather than isolated CRUD screens.

A production order can connect:

```text
Production Order
       │
       ├── Product
       │
       ├── Required Materials
       │
       ├── Reservations
       │
       ├── Operations
       │
       ├── Consumption
       │
       ├── Incidents
       │
       └── Traceability
```

This makes it possible to model the actual lifecycle of manufacturing work.

For a furniture-oriented example:

```text
Customer Order
      ↓
Production Order
      ↓
Product / Family
      ↓
Components
      ↓
Material Requirements
      ↓
Stock Reservation
      ↓
Production
      ↓
Bultos / Components
      ↓
Finished Product
```

The domain model can therefore reflect the type of manufacturing processes that exist in real industrial environments.

---

# Traceability

Traceability is one of the central architectural concepts.

Instead of only storing the current state:

```text
Stock = 125 units
```

the system should be able to reconstruct how that state was reached:

```text
10:14  Receipt       +200
11:32  Reservation   -40
13:08  Adjustment     -5
15:21  Consumption   -30
17:02  Transfer       -10

Current stock: 115
```

This creates an operational timeline.

The goal is not just to know **what the system says now**.

It is to understand **how it got there**.

---

# Auditability

Operational systems need accountability.

Important actions should generate an audit trail containing information such as:

```text
Actor
Action
Entity
Previous state
New state
Timestamp
Context
```

For example:

```json
{
  "action": "stock.reserved",
  "entity": "material",
  "entity_id": 1842,
  "actor_id": 17,
  "previous_quantity": 120,
  "new_quantity": 95
}
```

This allows operational changes to be investigated instead of disappearing into a database update.

---

# Modular architecture

The platform is designed so that common capabilities belong to the core while domain-specific functionality is implemented through modules.

Conceptually:

```text
                    PLATFORM CORE
                         │
        ┌────────────────┼────────────────┐
        │                │                │
        ▼                ▼                ▼
    Inventory        Workflow         Identity
        │                │                │
        └────────────────┼────────────────┘
                         │
                 ┌───────┴────────┐
                 │                │
                 ▼                ▼
            Manufacturing       Quality
                 │
                 ▼
             Logistics
```

A company should not need to activate every capability.

Modules can be enabled according to the operational requirements of the environment.

---

# Domain-driven thinking

The application is intentionally being designed around domain concepts rather than database tables.

For example, instead of thinking only in terms of:

```text
stocks
orders
products
movements
```

the application reasons about:

```text
Reservation
Stock Movement
Production Order
Material Requirement
Consumption
Transfer
Workflow
Traceability
```

This distinction becomes important as the application grows.

A manufacturing platform becomes difficult to maintain when business rules are scattered across controllers, views and database queries.

The goal is to keep those rules explicit.

---

# Application architecture

The project follows a layered Laravel architecture.

```text
HTTP / UI
    ↓
Controll
```
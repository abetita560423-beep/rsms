# SummitHub: Real Estate Management System (RSMS)
## Project Documentation

---

### **CHAPTER I: THE PROBLEM AND ITS BACKGROUND**

#### **I. Introduction**
SummitHub is a comprehensive Real Estate Management System (RSMS) developed to modernize the property transaction process. In an era where digital presence is paramount, SummitHub serves as a bridge between property sellers and potential buyers, offering a streamlined platform for property listing, discovery, and communication. The system is built using the Laravel framework, leveraging its robust security features and MVC architecture to ensure a seamless experience for all users.

#### **II. Purpose and Value Proposition**
The primary purpose of SummitHub is to provide a centralized marketplace for real estate. 
- **Efficiency**: Reduces the time taken to list and discover properties.
- **Transparency**: Provides detailed property specifications and direct communication channels.
- **Quality Control**: Features an administrative moderation layer to verify listings before they go public.
- **Value**: For sellers, it offers a broader reach; for buyers, it provides a curated and searchable database of properties.

#### **III. Target Audience**
1. **Buyers**: Individuals looking to purchase or rent properties. They can explore listings, filter by criteria, and send inquiries.
2. **Sellers/Agents**: Users who want to list their properties. they have access to a dedicated dashboard to manage their listings and respond to leads.
3. **Staff/Moderators**: Internal users responsible for reviewing and approving property listings to maintain platform integrity.
4. **Administrators**: System overseers who manage user roles and overall platform health.

#### **IV. Core Functionalities**
- **Dynamic Property Listing**: Sellers can upload property details, including pricing, location, and images.
- **Search and Filter System**: A powerful explore page allows buyers to find properties based on keywords and categories.
- **Inquiry Management**: A built-in messaging system allows buyers to contact sellers directly.
- **Role-Based Dashboards**: Customized interfaces for different user roles (Buyer, Seller, Staff, Admin).
- **Moderation Workflow**: Listings must be approved by staff before appearing in the public catalog.

#### **V. Technical Feasibility**
The system is built on the **Laravel Framework**, ensuring:
- **Scalability**: Capable of handling increasing numbers of users and listings.
- **Security**: Built-in protection against common web vulnerabilities (CSRF, XSS, SQL injection).
- **Maintainability**: Clean code structure using Eloquent ORM and Blade templating.

---

### **CHAPTER II: DESIGN AND ARCHITECTURE**

#### **VI. Wireframes and Visual Design**

##### **1. Homepage Architecture**
The SummitHub interface is designed for high usability and responsiveness. Below are the core wireframe components and their technical descriptions:

![Homepage](file:///C:/Users/AaronPaul%20Betita/.gemini/antigravity/brain/f47de9fc-814e-4b1c-bad1-f571e9cfee51/homepage_1777560853245.png)
*Figure 1: The SummitHub Homepage Wireframe*

**Component Annotations:**

- **Navigation Bar Home**: The interface includes a comprehensive navigation system featuring the Home page, Property Browsing (Explore), and About Us views. For authenticated users, it provides direct links to the Dashboard, Inquiry History, Notification Alerts, and User Profile settings.

- **Hero Section**: Includes a professional Welcome message with a brief description of the SummitHub marketplace. It features a high-visibility "Explore Properties" CTA button, allowing users to directly access and browse the property collection with a single click.

- **Featured Estate Section**: This section displays a curated selection of premier properties, each showcased with a high-quality property image, descriptive title, price, location, and key specifications (bedrooms/bathrooms). It includes a 'View Details' button for direct access to the full property profile.

##### **2. Dashboard Architecture (General Roles)**
The Dashboard is the centralized hub for all registered users, dynamically adjusting its interface based on the assigned role (Admin, Staff, Seller, or Buyer).

![Dashboard](file:///C:/Users/AaronPaul%20Betita/.gemini/antigravity/brain/f47de9fc-814e-4b1c-bad1-f571e9cfee51/dashboard_1777560967599.png)
*Figure 2: User Dashboard Architecture*

**Dashboard Annotations:**

- **Role-Based Sidebar**: A dynamic navigation menu that adjusts based on user authorization. It provides access to role-specific features like User Management (Admin), Property Moderation (Staff), Property Management (Seller), and Activity Tracking (Buyer).
- **Summary Statistics Cards**: Visual indicators showing real-time system metrics tailored to the user. For instance, Sellers see "Active Listings," while Staff see "Pending Approvals."
- **Activity Feed / Notification Center**: A centralized area for system alerts, such as new inquiries for sellers or listing status updates for buyers.
- **User Profile Management**: Direct access to update account preferences, security settings, and personal information.

##### **3. Property Listing & Functionality**
The property listing system is the core of the platform, featuring advanced tools for discovery and engagement.

**Listing Functionality Annotations:**

- **Category Filter**: Allows users to filter properties by type (e.g., Residential, Commercial, Land) to narrow down their search results efficiently.
- **Search and Keyword Filter**: A robust search functionality that enables users to find properties using specific terms, locations, or pricing ranges.
- **Navigation System**: Provides intuitive movement between the listing catalog, detailed property views, and inquiry forms.
- **Inquiry Management System**: A specialized communication portal where buyers can send messages and sellers can respond, with all history stored securely within the platform.
- **Property Details View**: A high-fidelity page displaying all property attributes, specifications (beds, baths, sqft), and direct owner contact options.

##### **4. Add Property Page**
The Add Property page serves as the primary submission interface for Sellers to list new properties on the platform. It is accessible exclusively to users with the Seller or Admin role, enforced via Laravel Middleware.

**Component Annotations:**

- **Property Title Field**: A required text input where the Seller provides the full name or descriptive title of the property (e.g., "Beautiful Family Home in Cebu"). This becomes the primary identifier for the listing across the platform.
- **Listing Type Dropdown**: A selection field for the seller to define the nature of the listing — either **For Sale** or **For Rent**. This value determines which filter category the property appears under on the Explore page.
- **Category Dropdown**: Classifies the property into a predefined type such as House, Condo, Apartment, Land, or Commercial. Enables buyers to filter properties by category during their search.
- **Price Field**: A numeric input for the listed price or rental rate. The system uses this value for display on the property card and detail page.
- **Location Field**: A text field for the property's address or area (e.g., "Cebu City, Philippines"). Used by the search filter system to match keyword-based queries.
- **Bedrooms / Bathrooms / Square Feet Fields**: Numeric specification fields that allow sellers to describe the physical attributes of the property for informed buyer decision-making.
- **Description Textarea**: A large freeform input field for the seller to write a detailed narrative about the property, including highlights, nearby amenities, and special features.
- **Property Images Upload**: Allows the seller to upload up to 8 images in JPG, PNG, or WEBP format. The first uploaded image is automatically set as the primary display image. Images are stored securely using Laravel's Storage system.
- **Submit Property Button**: Triggers form validation via Laravel's Request system. Upon successful submission, the property is saved to the database with a **Pending** status and routed to Staff for moderation approval before appearing publicly.

##### **5. My Inquiries Page**
The My Inquiries page is the centralized communication hub where users can view and manage all property-related messages. It serves a dual purpose: Sellers use it to view and respond to incoming buyer inquiries, while Buyers use it to track the messages they have sent.

**Component Annotations:**

- **Inquiry List / Inbox**: Displays all inquiries in a structured list format. Each item shows the property name, the sender or recipient's name, a message preview, and the timestamp of the last interaction.
- **Unread Indicator**: Highlights inquiries that have not yet been opened by the recipient, ensuring important buyer messages are not missed.
- **Inquiry Detail View**: Clicking an inquiry opens the full conversation thread, displaying the original message and all subsequent replies in a chronological format.
- **Reply Field**: A text input at the bottom of the conversation thread that allows the Seller or Buyer to send a follow-up message. Submitted replies are saved to the 'Inquiries' table and linked to the original inquiry record.
- **Delete Inquiry Control**: Allows the message owner to permanently remove an inquiry from their inbox, helping to keep the communication log organized.
- **Property Reference Link**: Each inquiry includes a direct link to the property it references, allowing users to revisit the listing details without navigating away from the inbox.

##### **6. My Sales / Seller Transactions Page**
The My Sales page is the centralized hub where Sellers manage the **Consensus Agreement** workflow. It facilitates a secure multi-step transaction process where both parties must provide confirmation before a deal is marked as finalized.

**Summary Statistics Cards:**

- **Completed Deals Card**: Displays the total count of successfully finalized transactions. Color-coded in green to indicate successfully closed deals.
- **Awaiting Receipt Card**: Shows transactions where the Buyer has confirmed payment, but the Seller has not yet verified the receipt of funds.
- **Pending Requests Card**: Shows active payment requests sent to Buyers that are still awaiting their initial confirmation.
- **Total Earnings Card**: An aggregated sum of all completed transaction amounts in Philippine Peso (₱), providing a real-time revenue snapshot.

**Transaction History Table:**

- **Property Column**: Displays a thumbnail image of the property alongside its title and location, enabling quick identification of each deal.
- **Buyer Column**: Shows the full name and email address of the buyer involved in each deal, supporting direct follow-up and traceability.
- **Final Amount Column**: Displays the agreed-upon transaction price in Philippine Peso (₱), formatted for clarity.
- **Status Badge**: A color-coded label indicating the current state of the transaction consensus:
    - **Pending** (yellow): Seller has sent the offer; awaiting Buyer confirmation.
    - **Buyer Confirmed** (blue): Buyer has accepted the offer and sent payment; awaiting Seller's final verification.
    - **Completed** (green): Seller has confirmed receipt of funds; deal is fully finalized and property is marked as Sold/Rented.
    - **Cancelled** (red): The transaction was terminated by either party.
- **Action Controls**: Contextual buttons allowing the Seller to "Verify Receipt & Finalize" once a Buyer has confirmed payment.

##### **7. Payment Request Modal (Consensus Step)**
The Payment Request Modal is the interface used by Sellers to initiate the formal transaction process. It ensures all financial terms are clearly defined before the Buyer provides their confirmation.

**Component Annotations:**
- **Inquiry / Buyer Selector**: A dropdown menu allowing the Seller to select an open inquiry from a potential buyer to initiate the deal.
- **Final Agreed Price (₱)**: A numeric input field where the Seller enters the final negotiated price (e.g., ₱100.00). This field includes a dynamic discount calculator that notifies the Seller of the savings provided to the Buyer.
- **Note to Buyer (Optional)**: A text area where the Seller can provide specific instructions, payment details (e.g., Gcash number), or a personal message regarding the transaction.
- **Actions**:
    - **Cancel / Close**: Discards the request and returns the Seller to the transaction list.
    - **Send Payment Request**: Formally submits the offer to the Buyer and triggers a system notification.

#### **VII. Task Analysis**

1. **Login and Dashboard Access**
The user logs in with their credentials. Upon successful authentication, they are redirected to a role-based Dashboard (Admin, Staff, Seller, or Buyer) displaying relevant metrics such as active listings, pending inquiries, or recent transaction activity.

2. **Initiating the Inquiry (Property Interest)**
A Buyer navigates to the 'Explore' collection, selects a property, and submits an inquiry form. This creates a secure communication link between the Buyer and the Property Owner (Seller).

3. **System & Moderation Checks**
- **Approval Check**: The system ensures only properties with an **'Approved'** status from Staff moderation are visible and inquiry-ready.
- **Availability Check**: The system verifies if the property is still available (not yet Sold or Rented).
    - If unavailable, the inquiry form is disabled.
    - If available, the inquiry is successfully delivered to the Seller's inbox.

4. **Initiating the Transaction (Payment Request)**
After successful negotiation via the inquiry chat, the Seller initiates the formal transaction from the 'My Sales' page by clicking **"Create Payment Request"**. They specify the final agreed price and provide payment instructions (e.g., GCash/PayMaya details).

5. **Consensus: Buyer Action**
The Buyer receives a notification and reviews the Payment Request in their 'My Purchases' dashboard. 
- **Action**: The Buyer clicks **"Confirm & I've Sent Payment"** to acknowledge they have transferred the funds.
- **Status Update**: The transaction moves to **'Buyer Confirmed'**, notifying the Seller to verify.

6. **Consensus: Seller Verification**
The Seller reviews the 'Awaiting Receipt' list.
- **Action**: After verifying the funds in their account, the Seller clicks **"Verify & Done"**.
- **Outcome**: The transaction is marked as **Completed**, and a success notification is sent to the Buyer.

7. **System Finalization**
Once the transaction is completed:
- The property status is automatically updated (e.g., from **'Approved'** to **'Sold'** or **'Rented'**).
- The deal is recorded in the permanent transaction history for revenue tracking.
- The property listing is removed from the public 'Explore' catalog.

#### **VIII. Technical Implementation Details**

**Laravel Framework Implementation:**

- **Blade Templating**: Utilizes `@extends('layouts.app')` for a unified design language. The system follows a component-based architecture using `@include` for reusable elements like property cards, status badges, and transaction modals.
- **Validation Logic**:
    - **Add Property**: Enforces required fields and supports high-resolution image uploads (up to 100MB per file).
    - **Inquiry Management**: Prevents users from messaging their own listings and ensures data integrity.
    - **Transaction Workflow**: Validates that payment amounts are non-negative and ensures users can only confirm transactions they are authorized to participate in.

**System Routes:**

- **GET /dashboard**: Entry point for user-specific activity.
- **GET /explore**: Main property catalog with keyword search.
- **POST /properties**: Secure property creation and updates.
- **GET /seller/transactions**: Seller-side sales and consensus management.
- **POST /transactions/payment-request**: Endpoint for initiating the deal.
- **POST /transactions/confirm**: Buyer-side consensus confirmation.
- **POST /transactions/finalize**: Seller-side receipt verification.

**Advanced Features:**

- **Dynamic Search & Filtering**: Efficient property discovery using multi-criteria filters (Category, Location, Price).
- **Consensus Workflow**: A secure, multi-step agreement system requiring actions from both Buyer and Seller.
- **Real-time Notifications**: Feedback system providing instant alerts for new inquiries and transaction status changes.
- **Modal-Based Interactivity**: Critical actions are handled via Bootstrap 5 modals to keep users within their current dashboard context.
- **High-Limit Media Support**: Optimized for high-quality real estate photography with 100MB file upload capabilities.

#### **IX. Gantt Chart**
The development of SummitHub followed a structured timeline from September 2025 to November 2025, ensuring each phase from planning to finalization was executed with precision.

| Process | Start Dev | End Dev | Duration |
| :--- | :--- | :--- | :--- |
| **Project Planning** | September 3, 2025 | September 10, 2025 | 7 Days |
| **Database Design (ERD, Migration)** | September 10, 2025 | September 14, 2025 | 4 Days |
| **Wireframing & UI/UX** | September 14, 2025 | September 21, 2025 | 7 Days |
| **Frontend Development (Blade, CSS, JS)** | September 21, 2025 | October 6, 2025 | 15 Days |
| **Backend Development (M, C, R)** | October 6, 2025 | October 24, 2025 | 18 Days |
| **Testing & Debugging** | October 24, 2025 | November 13, 2025 | 20 Days |
| **Documentation & Finalization** | November 13, 2025 | November 27, 2025 | 14 Days |

*(Placeholder: [Insert Gantt Chart Graphic Here])*
*Figure X: SummitHub Project Development Timeline*


#### **X. Entity Relationship Diagram (ERD) Explanation**
- **Users Table**: Stores core identity and authentication data. Acts as the parent for Properties and Inquiries.
- **Properties Table**: Contains property attributes (price, location, features) with a Foreign Key to the User (Owner).
- **Transactions Table**: Manages the consensus deal process, tracking amounts, statuses, and payment timestamps.
- **Inquiries Table**: Facilitates communication between Buyers and Sellers, tracking property-specific messages.
- **Roles Table**: Handles permission logic to ensure users only access their authorized features.

---

### **CHAPTER III: USER INTERFACE MANUAL**

#### **XI. User Interface Manual**

##### **1. Login & Authentication**

**1.1 Accessing the System**
Open your browser and navigate to the application URL. You'll see the Login Page featuring:
- Email input field
- Password input field
- "Remember me" checkbox
- "Sign up" link for new users

**1.2 Creating an Account**
Click "Sign up" at the bottom of the login page. Fill in the registration form:
    Full Name
    Email (must be unique)
    User Role (Choose: Buyer or Seller)
    Password (minimum 8 characters)
    Confirm Password
Click "Register". You're automatically logged in and redirected to your dashboard.

**1.3 Logging In**
Enter your email and password. Click "Log in". System validates credentials and redirects you to:
- **Buyer/Seller Dashboard** (for general users)
- **Admin Dashboard** (for staff/super admins)

**1.4 Password Recovery**
- Click "Forgot your password?" on the login page.
- Enter your registered email.
- Click "Email Password Reset Link".
- Check your email, click the link, and enter a new password.

##### **2. User Dashboard**

**2.1 Dashboard Overview**
Upon login, you see summary cards displaying:
- **Active Listings**: Properties currently published (for Sellers).
- **Total Inquiries**: Number of active inquiries received/sent.
- **Pending Deals**: Transactions awaiting consensus confirmation.
- **Total Revenue/Spend**: Outstanding balance or finalized amounts.

**2.2 Navigation Menu**
The top navigation bar includes:
- **Home**: Main landing page and featured listings.
- **Explore**: Browse the full property collection.
- **Dashboard**: Your role-specific activity center.
- **Notifications**: System alerts for inquiries and deals.
- **Profile Menu**: Access settings or Logout.

##### **3. Browsing & Inquiring Properties**

**3.1 Accessing Property Collection**
Click "Explore" in the navigation menu. The page displays:
- Search bar at the top.
- Category filter dropdown (House, Condo, Apartment, Land).
- Grid of property cards with high-quality thumbnails.

**3.2 Searching for Properties**
- Type property title, location, or keyword in the search bar.
- Results filter automatically or upon clicking search.
- Use the "All Categories" dropdown to filter by property type.

**3.3 Viewing Property Details**
Click on any property card. A dedicated page opens showing:
- Property image gallery (supporting high-resolution uploads).
- Title, Price (₱), and Type (Sale/Rent).
- Specifications (Bedrooms, Bathrooms, Sqft, Location).
- Full Description.
- "Send Inquiry" form (if the property is available).

**3.4 Sending an Inquiry**
1. On the property details page, type your message in the inquiry box.
2. Click "Send Message".
3. **System Checks**:
    - You are logged in.
    - Property is available (not Sold/Rented).
4. A success message appears, and the Seller is notified.
5. You are redirected to your inquiry list.

##### **4. Managing Your Transactions (Consensus Agreement)**

**4.1 Viewing Sales & Purchases**
- Navigate to **Dashboard → My Sales** (Seller) or **My Purchases** (Buyer).
- Page shows summary cards for Completed Deals and Awaiting Receipt.

**4.2 Status Badges**
- **Pending (Yellow)**: Seller sent an offer; awaiting Buyer confirmation.
- **Buyer Confirmed (Blue)**: Buyer acknowledged payment; awaiting Seller receipt.
- **Completed (Green)**: Seller verified funds; deal is fully finalized.
- **Cancelled (Red)**: Transaction terminated.

**4.3 Initiating a Transaction (Seller)**
1. Go to **My Sales** and click **"Create Payment Request"**.
2. Select the relevant **Inquiry/Buyer**.
3. Enter the **Final Agreed Price** (allows for negotiated discounts).
4. Enter a **Note to Buyer** (e.g., payment instructions).
5. Click **"Send Offer"**.

**4.4 Confirming Payment (Buyer)**
1. Go to **My Purchases**. Find deals marked **"Action Required"**.
2. Click **"Confirm & I've Sent Payment"** after you have transferred the funds.
3. Success toast: "Confirmation sent! Awaiting seller verification."

**4.5 Finalizing the Deal (Seller)**
1. Go to **My Sales**. Find deals marked **"Verify Receipt"**.
2. After confirming funds in your account, click **"Verify & Done"**.
3. Success toast: "Deal finalized! Property marked as Sold/Rented."

##### **5. Notifications**
- **Bell Icon**: Top-right; red badge shows unread count.
- **Types**: New Inquiry, Payment Request, Deal Finalized, Property Approved/Rejected.
- **Manage**: Click bell to see dropdown with timestamps and messages.

##### **6. Admin & Staff Dashboard**
- **Access**: Staff/Admin login reveals enhanced dashboard.
- **Stats**: Total active listings, pending approvals, total users, system revenue.
- **Menu**: Property Moderation, Category Management, User Management, Activity Logs.

##### **7. Property Moderation (Admin)**
- Navigate to **Staff → Pending Approvals**.
- Table shows all listings submitted by Sellers.
- **Actions**:
    - **Approve**: Listing becomes public on the Explore page.
    - **Reject**: Listing is hidden; Seller is notified to correct issues.

##### **8. Category Management**
- Admins can add, edit, or delete property categories (e.g., "Commercial", "Warehouse").
- Shows book counts per category.

##### **9. User Management**
- Table shows: ID, Name, Email, and current Role.
- **Roles**: Buyer, Seller, Staff, Admin.
- **Deactivate User**: Admins can disable accounts while preserving transaction history.

##### **10. Activity Log Process**
- Tracks all critical actions: logins, logouts, property approvals, and deal finalizations.
- Summary cards show Total Activities and Today's Activity count.

---

#### **XII. Feature Highlights**

**1. Secure Authentication & Role-Based Access Control (RBAC)**
- **User Benefit**: Protects sensitive data; Buyers cannot list properties, and Staff only see moderation tools.
- **Laravel Implementation**: Built-in authentication with Bcrypt hashing and custom `RoleMiddleware` to enforce granular access.

**2. Real-Time Property Catalog with Search & Filter**
- **User Benefit**: Find properties in seconds with title/location search and category filters.
- **Laravel Implementation**: Eloquent ORM with query scopes (`available()`, `search()`) and responsive Blade templates.

**3. Secure Consensus Transaction System**
- **User Benefit**: Ensures trust by requiring a two-step confirmation (Buyer confirms payment, Seller confirms receipt).
- **Laravel Implementation**: Atomic `DB::transaction()` operations to ensure inventory and deal status update simultaneously.

**4. High-Limit Media Support (100MB)**
- **User Benefit**: Sellers can showcase properties with high-resolution imagery without compression issues.
- **Laravel Implementation**: Optimized PHP configurations (`post_max_size`, `upload_max_filesize`) and custom file validation rules.

**5. Integrated Consensus Verification Workflow**
- **User Benefit**: Transparent status tracking for both parties at every stage of the sale.
- **Laravel Implementation**: Eloquent relationships linking `User`, `Property`, and `Deal` models with status-specific notification triggers.

**6. Responsive Admin & Moderation Tools**
- **User Benefit**: Staff can manage hundreds of listings efficiently with one-click approval workflows.
- **Laravel Implementation**: Aggregated dashboard metrics using Eloquent `count()` and `sum()` for real-time system monitoring.

**7. Multi-Channel Notification System**
- **User Benefit**: Reduces manual follow-ups by alerting users instantly of new leads or deal updates.
- **Laravel Implementation**: Laravel Database Notifications with unread badge tracking in the navigation bar.

**8. Responsive Design with Modern Aesthetics**
- **User Benefit**: Seamless experience across mobile, tablet, and desktop devices.
- **Laravel Implementation**: Built with a mobile-first philosophy using Vanilla CSS and Bootstrap 5 utilities for fast loading.

---

#### **XIII. Conclusion**
SummitHub (RSMS) stands as a premier solution for the real estate market, combining high-capacity media support with a secure consensus-based transaction model. Its robust architecture and user-centric design ensure a seamless experience for buyers, sellers, and administrators alike.

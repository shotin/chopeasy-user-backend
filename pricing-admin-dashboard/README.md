# ChopWell Pricing Admin Dashboard

Production-ready React.js admin dashboard for managing the ChopWell pricing engine.

## Features

- ✅ Complete CRUD for Pricing Configurations
- ✅ Complete CRUD for Weight Tiers  
- ✅ Complete CRUD for Rider Payout Rules
- ✅ Pricing Preview & Simulation Tool
- ✅ Real-time validation
- ✅ Role-based access control
- ✅ Professional UI/UX
- ✅ Responsive design
- ✅ TypeScript support

## Prerequisites

- Node.js 16+ and npm
- Laravel backend running at `http://localhost:8000`
- Admin user credentials

## Installation

```bash
cd pricing-admin-dashboard
npm install
```

## Configuration

Create `.env` file:

```env
REACT_APP_API_URL=http://localhost:8000/api/v1
REACT_APP_APP_NAME=ChopWell Admin
```

## Running

```bash
npm start
```

Dashboard will open at `http://localhost:3000`

## Default Login

Ask your super admin for credentials or create one in Laravel:

```bash
php artisan tinker
>>> $user = User::create(['email' => 'admin@chopwell.com', 'password' => bcrypt('password'), ...]);
>>> $user->assignRole('Admin');
```

## Project Structure

```
src/
├── components/          # Reusable UI components
├── pages/              # Page components
│   ├── Dashboard.tsx
│   ├── PricingConfigs/
│   ├── WeightTiers/
│   └── RiderPayoutRules/
├── services/           # API service layer
├── context/            # React Context (Auth, etc)
├── types/              # TypeScript interfaces
├── utils/              # Helper functions
└── App.tsx            # Main app component
```

## API Endpoints Used

All endpoints from Laravel backend:

### Admin Pricing Management
- `GET /admin/pricing-config` - List configs
- `POST /admin/pricing-config` - Create config
- `PATCH /admin/pricing-config/{id}` - Update config
- `DELETE /admin/pricing-config/{id}` - Delete config
- `POST /admin/pricing-preview` - Preview pricing
- `POST /admin/pricing-validate` - Validate config

### Weight Tiers
- `GET /admin/weight-tiers` - List tiers
- `POST /admin/weight-tiers` - Create tier
- `POST /admin/weight-tiers/bulk` - Bulk create
- `PATCH /admin/weight-tiers/{id}` - Update tier
- `DELETE /admin/weight-tiers/{id}` - Delete tier

### Rider Payout Rules
- `GET /admin/rider-payout-rules` - List rules
- `POST /admin/rider-payout-rules` - Create rule
- `PATCH /admin/rider-payout-rules/{id}` - Update rule
- `DELETE /admin/rider-payout-rules/{id}` - Delete rule

## Features

### 1. Dashboard Overview
- Active pricing configurations
- Summary statistics
- Quick actions

### 2. Pricing Configuration Management
- Create/Edit/Delete configs
- Toggle active status
- View associated orders

### 3. Weight Tiers Management
- Manage weight ranges (1-50kg+)
- Configure multipliers
- Bulk import/export

### 4. Rider Payout Rules
- Distance-based rules
- Weight-based adjustments
- Priority management

### 5. Pricing Preview Tool
- Test pricing scenarios
- Real-time calculations
- Export results

## Build for Production

```bash
npm run build
```

Deploy the `build/` folder to your web server.

## Troubleshooting

### CORS Issues
Add to Laravel `config/cors.php`:
```php
'paths' => ['api/*'],
'allowed_origins' => ['http://localhost:3000'],
```

### Authentication Issues
Ensure JWT tokens are properly set in localStorage after login.

## Support

For issues, check the Laravel backend logs and browser console.

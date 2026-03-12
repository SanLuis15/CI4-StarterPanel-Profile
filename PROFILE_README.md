# Student Profile Page - Implementation Guide

## Database Setup

### Database Name
`ci4_crud_exam` (or your existing database name)

### Run Migration
Open phpMyAdmin or MySQL terminal and execute:
```sql
mysql -u root -p ci4_crud_exam < profile_migration.sql
```

Or manually run the SQL in `profile_migration.sql` file.

## Installation Steps

1. **Run the SQL Migration**
   - Open phpMyAdmin
   - Select your database
   - Go to SQL tab
   - Copy and paste the content from `profile_migration.sql`
   - Click "Go" to execute

2. **Create Upload Directory**
   - Directory already created: `public/uploads/profiles/`
   - Make sure it has write permissions

3. **Test the Application**
   - Login with your existing credentials
   - Click on your username dropdown in the header
   - Click "Profile" to view your profile
   - Click "Edit Profile" to update information
   - Upload a profile image (max 2MB)

## Testing Credentials

Use your existing user credentials from the `users` table.

Default admin (if exists):
- Username: admin
- Password: (your admin password)

## Features Implemented

✅ Profile display page with avatar
✅ Profile edit form with all fields
✅ Image upload with live preview
✅ Image validation (JPG, PNG, WEBP, max 2MB)
✅ Old image deletion when uploading new one
✅ Form validation with error messages
✅ Session update after profile changes
✅ Bootstrap 5 responsive design

## File Structure

```
app/
├── Controllers/
│   └── ProfileController.php (show, edit, update methods)
├── Models/
│   └── UserModel.php (with updateProfile method)
├── Views/
│   └── profile/
│       ├── show.php (profile display)
│       └── edit.php (edit form with live preview)
└── Config/
    └── Routes.php (profile routes added)

public/
└── uploads/
    └── profiles/ (profile images storage)

profile_migration.sql (database migration)
```

## Routes Added

- GET `/profile` - View profile
- GET `/profile/edit` - Edit profile form
- POST `/profile/update` - Update profile

## Database Columns Added

- `student_id` VARCHAR(20)
- `course` VARCHAR(100)
- `year_level` TINYINT
- `section` VARCHAR(50)
- `phone` VARCHAR(20)
- `address` TEXT
- `profile_image` VARCHAR(255)

## Notes

- Profile images are stored in `public/uploads/profiles/`
- Database only stores the filename, not the full path
- Old images are automatically deleted when uploading new ones
- All profile fields are optional except fullname and username
- Live image preview works before form submission

## Troubleshooting

1. **Upload folder not writable**
   - Check folder permissions: `chmod 777 public/uploads/profiles/`

2. **Image not uploading**
   - Check form has `enctype="multipart/form-data"`
   - Check file size is under 2MB
   - Check file type is JPG, PNG, or WEBP

3. **Session not updating**
   - Clear browser cache
   - Check session configuration in `app/Config/App.php`

## Submission Checklist

✅ SQL migration file included
✅ ProfileController created
✅ UserModel updated
✅ Profile views created
✅ Routes configured
✅ Upload directory created
✅ Header navigation updated
✅ README included

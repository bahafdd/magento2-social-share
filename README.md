How to install, configure, and use the **Themestar Social Share** Magento 2 module.

---


# Themestar Social Share for Magento 2

A customizable Magento 2 extension to enable social media sharing with support for Facebook, Twitter, LinkedIn, WhatsApp, Pinterest, and Reddit. Includes features like Open Graph and Twitter Cards, along with customizable icon designs and colors.

---

## 📦 Installation

### Composer (Recommended)
```bash
composer require themestar/module-socialshare
bin/magento module:enable Themestar_SocialShare
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:flush
```

### Manual
1. Download or clone this repository into `app/code/Themestar/SocialShare`.
2. Enable the module:
```bash
bin/magento module:enable Themestar_SocialShare
bin/magento setup:upgrade
```

---

## ⚙ Configuration

Navigate to **Stores > Configuration > Themestar > Social Share** in the Magento Admin Panel.

### 1. General Settings
- **Enable Social Share Module**: Toggle the extension on/off.

### 2. Facebook Settings
- **Enable Facebook Icon**
- **Select Facebook Button Design**: Choose from available design versions.
- **Facebook Icon Color**
- **Facebook Background Color**
- **Enable Facebook Open Graph (OG)**: Enables meta tags for Facebook sharing.

### 3. Twitter Settings
- **Enable Twitter Icon**
- **Twitter Icon Design**
- **Twitter Icon Color**
- **Twitter Background Color**
- **Enable Twitter Card**
- **Select Twitter Card Type**: Options include `summary`, `summary_large_image`, `app`, or `player`.

### 4. LinkedIn Settings
- **Enable LinkedIn Icon**
- **LinkedIn Icon Design**
- **LinkedIn Icon Color**
- **LinkedIn Background Color**

### 5. WhatsApp Settings
- **Enable WhatsApp Icon**
- **WhatsApp Icon Design**
- **WhatsApp Icon Color**
- **WhatsApp Background Color**

### 6. Pinterest Settings
- **Enable Pinterest Icon**
- **Pinterest Icon Design**
- **Pinterest Icon Color**
- **Pinterest Background Color**

### 7. Reddit Settings
- **Enable Reddit Icon**
- **Reddit Icon Design**
- **Reddit Icon Color**
- **Reddit Background Color**

### 8. Custom CSS
- Add custom CSS styles specifically for the social share module.

---

## 🎨 Design Customization

Each platform supports customizable icon and background colors along with multiple design versions (size, border radius, shadow, etc.) provided by the `DesignVersions` source model.

A color picker is used in the admin panel for easy selection.

---

## 🧩 Dependencies

- Magento 2.3 or later
- PHP 7.3+

---

## 🛠 Developer Notes
- All platform buttons and meta tags are conditionally rendered based on admin configuration.

---

## 🧾 License

MIT License © [Themestar]


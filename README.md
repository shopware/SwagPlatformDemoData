# Shopware Demo Data Plugin

[![codecov](https://codecov.io/github/shopware/SwagPlatformDemoData/graph/badge.svg?token=X9E821G7N8)](https://codecov.io/github/shopware/SwagPlatformDemoData)

**Not for production use!** This plugin is intended for development and testing environments only.

## Overview

The **Shopware Demo Data Plugin** provides sample data for Shopware 6. Upon activation, the plugin imports demo data, which may overwrite existing data.

## Installation

### Option 1: Using the Shopware Administration
1. Download the ZIP file.
2. Upload the extension via the **Shopware Administration**.
3. Install and activate the plugin.

### Option 2: Using the Command Line
1. Clone the repository into the `custom/plugins` directory of your Shopware 6 installation:
   ```sh
   git clone https://github.com/shopware/SwagPlatformDemoData.git custom/plugins/SwagPlatformDemoData
   ```
2. Run the following commands from the Shopware root directory:
   ```sh
   bin/console plugin:refresh
   bin/console plugin:install --activate SwagPlatformDemoData
   ```

## License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

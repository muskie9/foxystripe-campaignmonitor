# foxystripe-campaignmonitor
Campaign Monitor integration module for FoxyStripe

### Example Settings
In your `mysite/_config/config.yml`:

```
---
Name: mysite
After: 'framework/*','cms/*'
---
# YAML configuration for SilverStripe
# See http://doc.silverstripe.org/framework/en/topics/configuration
# Caution: Indentation through two spaces, not tabs
SSViewer:
  theme: 'simple'
Foxy2CM:
  APIKey: "APIKEYHERE"
  ClientID: "CLIENTIDHERE"
  ListID: "LISTIDHERE"
```

### Todo:
- Add instructions on where to find the different required keys in Campaign Monitor
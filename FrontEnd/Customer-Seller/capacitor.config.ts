import { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.trio.takeit',
  appName: 'TakeIT',
  webDir: 'www',
  bundledWebRuntime: false,
  "plugins": {
    "SplashScreen": {
      "enabled": false,
      "launchShowDuration": 0,
      "launchAutoHide": false,
      "backgroundColor": "ffffff"
    }
  },
  cordova: {}
};

export default config;

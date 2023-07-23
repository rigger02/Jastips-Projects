import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-account-setting',
  templateUrl: './account-setting.page.html',
  styleUrls: ['./account-setting.page.scss'],
})
export class AccountSettingPage {
  nama: string | undefined;
  email: string | undefined;
  password: string | undefined;

  constructor(private navCtrl: NavController) {}

  simpan() {
    this.navCtrl.back();
  }
}


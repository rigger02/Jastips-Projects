import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Preferences } from '@capacitor/preferences';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-account',
  templateUrl: './account.page.html',
  styleUrls: ['./account.page.scss'],
})
export class AccountPage implements OnInit {

  isLogin: boolean = false
  constructor(
    private navCtrl: NavController

  ) { }

  ngOnInit() {
    const token = localStorage.getItem('token')
    if(token){
      this.isLogin = true
    }

  }

  async login(){
    await this.navCtrl.navigateForward("/onboard")
  }

  async logout(){
    Preferences.clear()
    localStorage.clear()
    await this.navCtrl.navigateForward("/c-tabs")
  }

}

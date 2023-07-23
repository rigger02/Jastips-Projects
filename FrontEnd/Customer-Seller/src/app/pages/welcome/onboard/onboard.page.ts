import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { GlobalService } from 'src/app/services/global/global.service';

@Component({
  selector: 'app-onboard',
  templateUrl: './onboard.page.html',
  styleUrls: ['./onboard.page.scss'],
})
export class OnboardPage implements OnInit {

  constructor(
    private router: Router,
    private global: GlobalService
    ) { }

  urlCheck:any
  url:any

  ngOnInit() {
    this.isLoggedIn()
    this.checkUrl()
  }

  checkUrl() {
    let url: any = (this.router.url).split('/');
    console.log('url: ', url);
    const spliced = url.splice(url.length - 2, 2); // /tabs/cart url.length - 1 - 1
    this.urlCheck = spliced[0];
    console.log('urlcheck: ', this.urlCheck);
    url.push(this.urlCheck);
    this.url = url;
    console.log(this.url);
  }

  isLoggedIn(){
    let role = localStorage.getItem('role')
    if(role === 'customer'){
      this.router.navigateByUrl('c-tabs')
    } else if(role === 'store'){
      this.router.navigateByUrl('s-tabs')
    }
  }

  reloadPrev(){
    this.global.reloadPrev()
  }

}

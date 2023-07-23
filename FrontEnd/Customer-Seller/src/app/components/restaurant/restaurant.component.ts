import { Component, Input, OnInit } from '@angular/core';  
import { formatCurrency } from '@angular/common';


@Component({
  selector: 'app-restaurant',
  templateUrl: './restaurant.component.html',
  styleUrls: ['./restaurant.component.scss'],
})
export class RestaurantComponent implements OnInit {

  @Input() stores: any;

  constructor() { }

  ngOnInit() {}

  formatRupiah(angka: number) {
    return formatCurrency(angka, 'id-ID', 'Rp ', 'IDR');
  }

}

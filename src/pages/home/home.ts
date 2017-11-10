import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';

import { Socket } from 'ng-socket-io'; //Importo socket.

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  nickname = '';


  constructor(public navCtrl: NavController, private socket: Socket) { }

  
  joinChat(){ //Declaro Funciones
    this.socket.connect();
    this.socket.emit('set-nickname', this.nickname);
    this.navCtrl.push('ChatRoomPage', { nickname: this.nickname});
  }

}

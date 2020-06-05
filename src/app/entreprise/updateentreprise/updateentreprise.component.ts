import {Component, OnInit} from '@angular/core';
import {EntrepriseService} from 'src/app/services/entreprise.service';
import {Entreprise} from 'src/app/models/Entreprise';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-updateentreprise',
  templateUrl: './updateentreprise.component.html',
  styleUrls: ['./updateentreprise.component.css']
})
export class UpdateentrepriseComponent implements OnInit {

  id: number;
  entreprises: Entreprise = new Entreprise();

  constructor(private entrserv: EntrepriseService, private route: ActivatedRoute, private router: Router) {
  }

  entreprise: Entreprise = new Entreprise();

  ngOnInit() {
    this.id = this.route.snapshot.params._id;
    this.entrserv.getEntreprise(this.id).subscribe(data => this.entreprises = data);
    console.log(this.entrserv.getEntreprise(this.id).subscribe(data => this.entreprises = data));

  }


  modifierentreprise() {
    this.entreprise = this.entreprises;
    this.entrserv.UpdateEntreprise(this.entreprise).subscribe(data => this.router.navigate(['/menu/entreprises']));
  }

}

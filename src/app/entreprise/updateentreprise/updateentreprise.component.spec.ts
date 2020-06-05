import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateentrepriseComponent } from './updateentreprise.component';

describe('UpdateentrepriseComponent', () => {
  let component: UpdateentrepriseComponent;
  let fixture: ComponentFixture<UpdateentrepriseComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UpdateentrepriseComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UpdateentrepriseComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

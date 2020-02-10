import React from 'react';
import { Modal } from 'react-bootstrap';
import { ScheduleComponent, Day, Week, WorkWeek, Month, Agenda, Inject } from '@syncfusion/ej2-react-schedule';
import { extend } from '@syncfusion/ej2-base';
import { loadCldr} from '@syncfusion/ej2-base';

loadCldr(
    require('cldr-data/supplemental/numberingSystems.json'),
    require('cldr-data/main/fr-CH/ca-gregorian.json'),
    require('cldr-data/main/fr-CH/numbers.json'),
    require('cldr-data/main/fr-CH/timeZoneNames.json')
);

/**
 * Props: {
 *  saveSchedules: (schedules: [][]number) => void
 *  onClose: () => void
 * }
 */
export default class SlideScheduler extends React.Component {
    constructor() {
        super(...arguments);
        this.data = extend([], undefined, true);
    }

    // checkSchedule() {
    //     // console.log("hettt",this.state.schedules)
    //     // if (schedules.length === 7 && schedules >= 0 && schedules <= 23) {
            
    //     // }
    //     // TODO: Check that schedules is of length 7 and only contains values between 0 and 23
    // }

    // addHourToSchedule(day, time) {
    //     // TODO: save clicked tile to schedule
    // }

    render() {
        return (
            <Modal show={true} onHide={this.props.onClose}>
                <Modal.Header closeButton></Modal.Header>
                <Modal.Body>
                    <ScheduleComponent width='100%' height='550px' selectedDate={new Date(2019, 11, 10)} firstDayOfWeek={1} >
                        <Inject services={[Day, Week, WorkWeek, Month, Agenda]}/>
                    </ScheduleComponent>
                </Modal.Body>
                <Modal.Footer>
                    {/* <button className="btn btn-info" onClick={() => this.props.saveSchedules(this.state.schedules)}>
                         Enregistrer
                    </button> */}
                    <div></div>
                </Modal.Footer>
            </Modal>
        );
    }
}


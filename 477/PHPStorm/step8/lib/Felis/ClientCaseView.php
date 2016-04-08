<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/16/16
 * Time: 4:07 PM
 */

namespace Felis;


class ClientCaseView extends View
{

    private $hidden;
    private $id;
    private $agents = array();

    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site, $get) {
        $this->setTitle("Edit Case");
        $this->site = $site;
        $this->get = $get;
        $this->id = $get['id'];
    }

    public function present() {

        $this->addLink("logout.php", "Log Out");
        $this->addLink("cases.php", "Cases");



        /*
		 * We may be editing an existing movie or
		 * adding a new movie. We determine that
		 * by checking to see if $get['i'] exists
		 */
        $number = '';
        $status = '';
        $agent = null;
        $summary = '';
        $id = '';
        $case = null;
        $agent_name = '';
        $client = '';
        $client_name = '';
        $verbose_status = '';
        $verbose_opposite_status = '';


        if(isset($this->get['id'])) {
            // Editing an existing movie
            $cases = new Cases($this->site);
            $case = $cases->get($this->get['id']);
            if($case !== null) {
                $number = $case->getNumber();
                $status = $case->getStatus();
                $summary = $case->getSummary();
                $agent_name = $case->getAgentName();
                $this->id = $this->get['id'];

                // When editing we add a hidden field with the id of
                // the movie we are editing.
                $this->hidden = '<input type="hidden" name="id" value="' . $id . '">';


                // Converting the O/C status bit to a string to display
                $verbose_status = $status == "O" ? "open" : "closed";
                $verbose_opposite_status = $status == "O" ? "closed" : "open";

                $client = $case->getClient();
                $client_name = $case->getClientName();

                $users = new Users($this->site);
                $this->agents = $users->getAgents();
            }
        } else {
            // Adding a new movie
            // Just use empty values
        }



     $html = <<<HTML

        <form method="post" action="post/clientcase.php?id=$this->id">
	<fieldset>
		<legend>Case</legend>
		<p>Client: $client_name</p>
		$this->hidden

		<p>
			<label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="Case Number"
				   value=$number>
		</p>
		<p>
			<label for="summary">Summary</label><br>
			<input type="text" id="summary" name="summary" placeholder="Summary"
				   value=$summary>

		</p>

		<p>
			<label for="agent">Agent in Charge: </label>
			<select id="agent" name="agent">
				<option selected>$agent_name</option>
HTML;
				foreach($this->agents as $agent) {
                    $name = $agent['name'];
                    $html .= "<option selected>$name</option>";
                }

        $html .= <<<HTML

			</select>
		</p>


		<p>
			<label for="status">Status: </label>
			<select id="status" name="status">
				<option selected>$verbose_status</option>
				<option>$verbose_opposite_status</option>
			</select>
		</p>
		<p>
			<input type="submit" value="Update" name="update">
		</p>

		<div class="notes">
		<h2>Notes</h2>

		<div class="timelist">
			<div class="report">
				<div class="info">
					<p class="time">2/10/2016 11:35am</p>
					<p class="agent">Martin, Harvey</p>
				</div>
				<p>Initial meeting with client. He's very concerned
					Felix will just not shut up at night. It's not like him to caterwaul so much, so there
					must be something going on in the neighborhood.</p>

			</div>

			<div class="report">
				<div class="info">
					<p class="time">2/14/2016 2:15pm</p>
					<p class="agent">Martin, Harvey</p>
				</div>
				<p>Met with the client to discuss the case.</p>
			</div>
		</div>

		<p>
			<label for="note">Notes</label><br>
			<textarea id="note" name="note" placeholder="Note"></textarea>
		</p>
		<p>
			<input type="submit" value="Add Note">
		</p>
		</div>

		<div class="reports">
			<h2>Reports</h2>

			<div class="timelist">
				<div class="report">
					<div class="info">
						<p class="time"><a href="report.php">2/12/2016 1:35am</a></p>
						<p class="agent">Martin, Harvey</p>
					</div>
					<p>Surveillance of neighborhood for three hours. Nothing untoward spotted.</p>

				</div>
			</div>

			<div class="timelist">
				<div class="report">
					<div class="info">
						<p class="time"><a href="report.php">2/13/2016 2:15am</a></p>
						<p class="agent">Martin, Harvey</p>
					</div>
					<p>Surveillance of neighborhood for two hours. Spotted a very attractive
						Siamese cat wandering though. Caterwauling commenced.</p>

				</div>
			</div>

			<p>
				<input type="submit" value="Add Report">
			</p>
		</div>

	</fieldset>
</form>

HTML;


        return $html;

    }

}
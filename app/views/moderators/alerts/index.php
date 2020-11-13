

<div>
    
    <a class="btn-blue" href="<?php echo URLROOT;?>/moderatoralerts/createCancellationAlerts">
            Create     
    </a> 
    <?php foreach ($data['alerts'] as $posts ): ?>
        <div class="container-item">
            <h2>
                <?php echo $posts->alertId;?>
            </h2>
        </div>
    <?php endforeach;?>
    <h3>
        <?php echo 'Created on: '. date("Y-m-d",strtotime($posts->date)).' at: '.date("H:i:sa",strtotime($posts->time));?>
    </h3>
</div>
export const calcStatus = (details) => {
  let num_live = details?.num_live || details?.num || 0
  let num = details?.num || 0
  let t1Score = details?.teams[0]?.match_score || 0
  let t2Score = details?.teams[1]?.match_score || 0
  let duration = details?.duration || 0
  let matchDataPresent = details?.has_match_data
  let matchDataNotPresent = !details?.has_match_data
  let winner = details?.winner
  let MatchStartTime = details?.datetime || 0
  
  let isLive = (details?.is_live || matchDataPresent)

  let isCurrentMapLive = num > t1Score + t2Score && isLive
  let isPickBansPhase = duration == 0 && (details?.has_picks || details?.has_bans)
  
  let isCurrentMapNotStarted = isCurrentMapLive && (isPickBansPhase || matchDataNotPresent)
  
  let isCurrentMapStarted = isCurrentMapLive && matchDataPresent && duration >= 0

  let isCurrentMapEnded = (num > 0 && num <= t1Score + t2Score) || !!winner
  let isBreak = isCurrentMapNotStarted
  
  let withPreview = isLive || MatchStartTime < getTimestampInSeconds()

  return {
    isLive: isLive,
    withPreview: withPreview,
    isCurrentMapLive: isCurrentMapLive,
    isPickBansPhase: isPickBansPhase,
    isCurrentMapNotStarted: isCurrentMapNotStarted,
    isCurrentMapStarted: isCurrentMapStarted,
    isCurrentMapEnded: isCurrentMapEnded,
    isBreak: isBreak,
    hasWinner: winner
  }
}


function getTimestampInSeconds () {
  return Math.floor(Date.now() / 1000)
}